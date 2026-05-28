<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Exam;
use App\Models\ExamSession;
use App\Models\Participant;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserExamSessionController extends Controller
{
    public function index()
    {
        $activeSession = ExamSession::where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'running', 'break'])
            ->latest()
            ->first();

        if ($activeSession) {
            return redirect()->route('user.exams.session.show', $activeSession);
        }

        $now = now();
        $availableExams = Exam::where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->get();

        return view('user.exams.session', compact('availableExams'));
    }

    public function start(Request $request)
    {
        $existingSession = ExamSession::where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'running', 'break'])
            ->exists();

        if ($existingSession) {
            return redirect()->route('user.exams.session.index')
                ->with('error', 'Anda masih memiliki sesi ujian aktif. Lanjutkan sesi yang sedang berjalan.');
        }

        $now = now();
        $examIds = Exam::where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->inRandomOrder()
            ->pluck('id')
            ->toArray();

        if (empty($examIds)) {
            return redirect()->route('user.exams.session.index')
                ->with('error', 'Saat ini tidak ada ujian yang tersedia. Silakan coba lagi nanti.');
        }

        return DB::transaction(function () use ($examIds, $now) {
            $session = ExamSession::create([
                'user_id' => Auth::id(),
                'exam_ids' => $examIds,
                'current_exam_id' => $examIds[0],
                'current_index' => 0,
                'status' => 'running',
                'started_at' => $now,
                'current_started_at' => $now,
            ]);

            Participant::create([
                'user_id' => Auth::id(),
                'exam_id' => $examIds[0],
                'exam_session_id' => $session->id,
                'started_at' => $now,
            ]);

            return redirect()->route('user.exams.session.show', $session);
        });
    }

    public function show(ExamSession $session)
    {
        $this->authorizeSession($session);

        if ($session->status === 'break') {
            if ($session->break_ends_at && now()->greaterThanOrEqualTo($session->break_ends_at)) {
                $session->update([
                    'status' => 'running',
                    'current_started_at' => now(),
                    'break_ends_at' => null,
                ]);
            } else {
                return redirect()->route('user.exams.session.break', $session);
            }
        }

        if ($session->status === 'completed') {
            return redirect()->route('user.exams.session.complete', $session);
        }

        // Redirect to first question
        $exam = $session->currentExam;
        if ($exam && $exam->questions->isNotEmpty()) {
            return redirect()->route('user.exams.session.question', [$session, $exam->questions->first()]);
        }

        abort(404);
    }

    public function showQuestion(ExamSession $session, Question $question)
    {
        $this->authorizeSession($session);

        if ($session->status === 'break') {
            if ($session->break_ends_at && now()->greaterThanOrEqualTo($session->break_ends_at)) {
                $session->update([
                    'status' => 'running',
                    'current_started_at' => now(),
                    'break_ends_at' => null,
                ]);
            } else {
                return redirect()->route('user.exams.session.break', $session);
            }
        }

        if ($session->status === 'completed') {
            return redirect()->route('user.exams.session.complete', $session);
        }

        // Ensure question belongs to current exam
        if ($question->exam_id !== $session->current_exam_id) {
            abort(404);
        }

        $question->load('options', 'statements');

        $exam = $session->currentExam;
        $participant = $session->participants()
            ->where('exam_id', $exam->id)
            ->first();

        if (! $participant) {
            $participant = Participant::create([
                'user_id' => Auth::id(),
                'exam_id' => $exam->id,
                'exam_session_id' => $session->id,
                'started_at' => now(),
            ]);
        }

        if (! $session->current_started_at) {
            $session->update(['current_started_at' => now()]);
        }

        $allowedSubmitAt = $session->current_started_at->clone()->addMinutes($exam->duration);
        $secondsRemaining = max(
            0,
            (int) $allowedSubmitAt->diffInSeconds(now(), false) * -1
        );

        // Get all questions for navigation
        $questions = $exam->questions->sortBy('id');
        $currentIndex = $questions->search(fn($q) => $q->id === $question->id);
        $totalQuestions = $questions->count();
        $nextQuestion = $questions->get($currentIndex + 1);
        $prevQuestion = $currentIndex > 0 ? $questions->get($currentIndex - 1) : null;

        // Check if question is answered
        $isAnswered = $participant->answers()->where('question_id', $question->id)->exists();

        return view('user.exams.question', compact(
            'session',
            'exam',
            'question',
            'participant',
            'secondsRemaining',
            'currentIndex',
            'totalQuestions',
            'nextQuestion',
            'prevQuestion',
            'isAnswered'
        ));
    }

    public function saveAnswer(Request $request, ExamSession $session, Question $question)
    {
        $this->authorizeSession($session);

        if ($session->status !== 'running') {
            return response()->json(['error' => 'Session not running'], 400);
        }

        // Ensure question belongs to current exam
        if ($question->exam_id !== $session->current_exam_id) {
            abort(404);
        }

        $participant = $session->participants()
            ->where('exam_id', $session->current_exam_id)
            ->firstOrFail();

        $validated = $request->validate([
            'answer' => ['required'],
        ]);

        $answerData = $validated['answer'];

        DB::transaction(function () use ($participant, $question, $answerData) {
            $participant->answers()->where('question_id', $question->id)->delete();

            if ($question->question_type === 'multiple_choice' && is_array($answerData)) {
                foreach ($answerData as $optionId) {
                    $option = $question->options->firstWhere('id', $optionId);
                    if (! $option) continue;

                    Answer::create([
                        'participant_id' => $participant->id,
                        'question_id' => $question->id,
                        'option_id' => $option->id,
                        'answer_text' => null,
                        'is_true' => false,
                        'is_correct' => $option->is_correct,
                    ]);
                }
            } elseif ($question->question_type === 'single_choice' && $answerData) {
                $option = $question->options->firstWhere('id', $answerData);
                if ($option) {
                    Answer::create([
                        'participant_id' => $participant->id,
                        'question_id' => $question->id,
                        'option_id' => $option->id,
                        'answer_text' => null,
                        'is_true' => false,
                        'is_correct' => $option->is_correct,
                    ]);
                }
            } elseif ($question->question_type === 'true_false_table' && is_array($answerData)) {
                foreach ($answerData as $statementId => $value) {
                    $statement = $question->statements->firstWhere('id', $statementId);
                    if (! $statement) continue;

                    Answer::create([
                        'participant_id' => $participant->id,
                        'question_id' => $question->id,
                        'option_id' => $statement->id, // Store statement ID in option_id for reference
                        'answer_text' => $value ? 'true' : 'false',
                        'is_true' => $value,
                        'is_correct' => $statement->correct_value == $value,
                    ]);
                }
            } else {
                $text = is_array($answerData) ? implode(', ', $answerData) : $answerData;
                $isCorrect = false;

                if ($question->question_type === 'short_answer') {
                    $isCorrect = strcasecmp(trim($text), trim($question->answer_key)) === 0;
                }

                Answer::create([
                    'participant_id' => $participant->id,
                    'question_id' => $question->id,
                    'option_id' => null,
                    'answer_text' => $text,
                    'is_true' => false,
                    'is_correct' => $isCorrect,
                ]);
            }
        });

        return response()->json(['success' => true]);
    }

    public function submit(Request $request, ExamSession $session)
    {
        $this->authorizeSession($session);

        if ($session->status !== 'running') {
            return redirect()->route('user.exams.session.index')
                ->with('error', 'Sesi ujian tidak dapat disubmit saat ini.');
        }

        $session->load('currentExam.questions.options');

        $exam = $session->currentExam;

        if (! $exam) {
            abort(404);
        }

        $participant = $session->participants()
            ->where('exam_id', $exam->id)
            ->firstOrFail();

        // Allow early submit, but check if minimum time has passed (optional)
        // $allowedSubmitAt = $session->current_started_at->clone()->addMinutes(5); // minimum 5 minutes
        // if (now()->lt($allowedSubmitAt)) {
        //     return back()->with('error', 'Anda belum boleh submit sebelum minimum waktu tercapai.');
        // }

        $participant->update(['completed_at' => now()]);

        $nextIndex = $session->current_index + 1;
        $examIds = $session->exam_ids;

        if (isset($examIds[$nextIndex])) {
            $session->update([
                'status' => 'break',
                'current_index' => $nextIndex,
                'current_exam_id' => $examIds[$nextIndex],
                'current_started_at' => null,
                'break_ends_at' => now()->addMinute(),
            ]);
        } else {
            $session->update([
                'status' => 'completed',
                'completed_at' => now(),
                'current_started_at' => null,
                'break_ends_at' => null,
            ]);
        }

        if ($session->status === 'break') {
            return redirect()->route('user.exams.session.break', $session);
        }

        return redirect()->route('user.exams.session.complete', $session);
    }

    public function break(ExamSession $session)
    {
        $this->authorizeSession($session);

        if ($session->status !== 'break') {
            return redirect()->route('user.exams.session.show', $session);
        }

        if ($session->break_ends_at && now()->greaterThanOrEqualTo($session->break_ends_at)) {
            $session->update([
                'status' => 'running',
                'current_started_at' => now(),
                'break_ends_at' => null,
            ]);

            Participant::create([
                'user_id' => Auth::id(),
                'exam_id' => $session->current_exam_id,
                'exam_session_id' => $session->id,
                'started_at' => now(),
            ]);

            return redirect()->route('user.exams.session.show', $session);
        }

        $secondsRemaining = max(0, now()->diffInSeconds($session->break_ends_at));

        return view('user.exams.break', compact('session', 'secondsRemaining'));
    }

    public function complete(ExamSession $session)
    {
        $this->authorizeSession($session);

        if ($session->status !== 'completed') {
            return redirect()->route('user.exams.session.show', $session);
        }

        $completedExams = $session->participants()->with('exam')->get();

        return view('user.exams.complete', compact('session', 'completedExams'));
    }

    private function authorizeSession(ExamSession $session): void
    {
        if ($session->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
