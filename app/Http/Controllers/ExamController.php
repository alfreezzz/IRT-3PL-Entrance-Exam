<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::latest()->get();

        return view('admin.exams.index', compact('exams'));
    }

    public function create()
    {
        return view('admin.exams.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:exams,slug',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'duration' => 'required|integer|min:0',
            'year' => 'required|integer|min:2000',
        ]);

        $year = $validated['year'];
        $validated['slug'] = $validated['slug']
            ?? Str::slug($validated['title'] . '-' . $year);

        Exam::create($validated);

        return redirect()->route('exams.index')->with('success', 'Subtes berhasil ditambahkan');
    }


    public function show(Exam $exam)
    {
        $exam->load(['questions.options']);

        return view('admin.exams.show', compact('exam'));
    }

    public function edit(Exam $exam)
    {

        return view('admin.exams.edit', compact('exam'));
    }

    public function update(Request $request, Exam $exam)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:exams,slug,' . $exam->id,
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'duration' => 'required|integer|min:0',
            'year' => 'required|integer|min:2000',
        ]);

        $year = $validated['year'];
        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title'] . '-' . $year);

        $exam->update($validated);

        return redirect()->route('exams.index')->with('success', 'Subtes berhasil diperbarui');
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();

        return redirect()->route('exams.index')->with('success', 'Subtes berhasil dihapus');
    }
}
