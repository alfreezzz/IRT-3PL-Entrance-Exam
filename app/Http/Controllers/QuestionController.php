<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Exam $exam)
    {
        return redirect()->route('exams.show', $exam);
    }

    public function create(Exam $exam)
    {
        return view('admin.questions.create', compact('exam'));
    }

    public function store(Request $request, Exam $exam)
    {
        $validated = $request->validate([
            'question_text' => 'required',
            'question_type' => 'required|in:short_answer,single_choice,multiple_choice,true_false_table',
            'answer_key' => 'nullable|string',
            'statements' => 'required_if:question_type,true_false_table|array|min:3|max:5',
            'statements.*.statement_text' => 'required_if:question_type,true_false_table|string',
            'statements.*.correct_value' => 'required_if:question_type,true_false_table|boolean',
        ]);

        $question = $exam->questions()->create([
            'question_text' => $validated['question_text'],
            'question_type' => $validated['question_type'],
            'answer_key' => $validated['answer_key'] ?? null,
        ]);

        // Create statements for true/false table questions
        if ($validated['question_type'] === 'true_false_table' && isset($validated['statements'])) {
            foreach ($validated['statements'] as $index => $statement) {
                $question->statements()->create([
                    'statement_text' => $statement['statement_text'],
                    'correct_value' => $statement['correct_value'],
                    'order' => $index + 1,
                ]);
            }
        }

        return redirect()->route('exams.show', $exam)->with('success', 'Soal berhasil ditambahkan');
    }

    public function show(Exam $exam, Question $question)
    {
        $question->load(['options', 'statements']);

        return view('admin.questions.show', compact('exam', 'question'));
    }

    public function edit(Exam $exam, Question $question)
    {
        return view('admin.questions.edit', compact('exam', 'question'));
    }

    public function update(Request $request, Exam $exam, Question $question)
    {
        $validated = $request->validate([
            'question_text' => 'required',
            'question_type' => 'required|in:short_answer,single_choice,multiple_choice,true_false_table',
            'answer_key' => 'nullable|string',
            'statements' => 'required_if:question_type,true_false_table|array|min:3|max:5',
            'statements.*.statement_text' => 'required_if:question_type,true_false_table|string',
            'statements.*.correct_value' => 'required_if:question_type,true_false_table|boolean',
        ]);

        $question->update([
            'question_text' => $validated['question_text'],
            'question_type' => $validated['question_type'],
            'answer_key' => $validated['answer_key'] ?? null,
        ]);

        // Handle statements for true/false table questions
        if ($validated['question_type'] === 'true_false_table') {
            // Delete existing statements
            $question->statements()->delete();

            // Create new statements
            if (isset($validated['statements'])) {
                foreach ($validated['statements'] as $index => $statement) {
                    $question->statements()->create([
                        'statement_text' => $statement['statement_text'],
                        'correct_value' => $statement['correct_value'],
                        'order' => $index + 1,
                    ]);
                }
            }
        } else {
            // If changing from true_false_table to another type, delete statements
            $question->statements()->delete();
        }

        return redirect()->route('exams.show', $exam)->with('success', 'Soal berhasil diperbarui');
    }

    public function destroy(Exam $exam, Question $question)
    {
        $question->delete();

        return redirect()->route('exams.show', $exam)->with('success', 'Soal berhasil dihapus');
    }
}
