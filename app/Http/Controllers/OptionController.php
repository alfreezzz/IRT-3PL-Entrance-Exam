<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function index(Question $question)
    {
        return redirect()->route('exams.questions.show', [$question->exam, $question]);
    }

    public function create(Question $question)
    {
        return view('admin.options.create', compact('question'));
    }

    public function store(Request $request, Question $question)
    {
        $validated = $request->validate([
            'option_text' => 'required|string',
            'is_correct' => 'boolean',
        ]);

        $question->options()->create([
            'option_text' => $validated['option_text'],
            'is_correct' => $request->boolean('is_correct'),
        ]);

        return redirect()->route('exams.questions.show', [$question->exam, $question])->with('success', 'Pilihan berhasil ditambahkan');
    }

    public function show(Option $option)
    {
        return redirect()->route('exams.questions.show', [$option->question->exam, $option->question]);
    }

    public function edit(Option $option)
    {
        return view('admin.options.edit', compact('option'));
    }

    public function update(Request $request, Option $option)
    {
        $validated = $request->validate([
            'option_text' => 'required|string',
            'is_correct' => 'boolean',
        ]);

        $option->update([
            'option_text' => $validated['option_text'],
            'is_correct' => $request->boolean('is_correct'),
        ]);

        return redirect()->route('exams.questions.show', [$option->question->exam, $option->question])->with('success', 'Pilihan berhasil diperbarui');
    }

    public function destroy(Option $option)
    {
        $question = $option->question;
        $option->delete();

        return redirect()->route('exams.questions.show', [$question->exam, $question])->with('success', 'Pilihan berhasil dihapus');
    }
}
