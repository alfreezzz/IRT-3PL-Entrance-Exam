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
        ]);

        $exam->questions()->create($validated);

        return redirect()->route('exams.show', $exam)->with('success', 'Soal berhasil ditambahkan');
    }

    public function show(Exam $exam, Question $question)
    {
        $question->load('options');

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
        ]);

        $question->update($validated);

        return redirect()->route('exams.show', $exam)->with('success', 'Soal berhasil diperbarui');
    }

    public function destroy(Exam $exam, Question $question)
    {
        $question->delete();

        return redirect()->route('exams.show', $exam)->with('success', 'Soal berhasil dihapus');
    }
}
