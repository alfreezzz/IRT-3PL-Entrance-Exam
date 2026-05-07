<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Subtest;
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
        $subtests = Subtest::all();

        return view('admin.exams.create', compact('subtests'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subtest_id' => 'required|exists:subtests,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'duration' => 'required|integer|min:0',
            'year' => 'required|integer|min:2000',
        ]);

        $subtest = Subtest::findOrFail($validated['subtest_id']);

        $year = $validated['year'];

        $title = $subtest->name . ' ' . $year;

        $slug = Str::slug($subtest->name . '-' . $year);

        // optional: biar slug unik
        $count = Exam::where('slug', 'like', $slug . '%')->count();

        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        Exam::create([
            'subtest_id' => $validated['subtest_id'],
            'title' => $title,
            'slug' => $slug,
            'description' => $subtest->description,
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'duration' => $validated['duration'],
            'year' => $year,
        ]);

        return redirect()
            ->route('exams.index')
            ->with('success', 'Subtes berhasil ditambahkan');
    }

    public function show(Exam $exam)
    {
        $exam->load(['questions.options']);

        return view('admin.exams.show', compact('exam'));
    }

    public function edit(Exam $exam)
    {
        $subtests = Subtest::all();

        return view('admin.exams.edit', compact('exam', 'subtests'));
    }

    public function update(Request $request, Exam $exam)
    {
        $validated = $request->validate([
            'subtest_id' => 'required|exists:subtests,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'duration' => 'required|integer|min:0',
            'year' => 'required|integer|min:2000',
        ]);

        $subtest = Subtest::findOrFail($validated['subtest_id']);

        $year = $validated['year'];

        $title = $subtest->name . ' ' . $year;

        $slug = Str::slug($subtest->name . '-' . $year);

        // pastikan slug unik selain data saat ini
        $count = Exam::where('slug', 'like', $slug . '%')
            ->where('id', '!=', $exam->id)
            ->count();

        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        $exam->update([
            'subtest_id' => $validated['subtest_id'],
            'title' => $title,
            'slug' => $slug,
            'description' => $subtest->description,
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'duration' => $validated['duration'],
            'year' => $year,
        ]);

        return redirect()
            ->route('exams.index')
            ->with('success', 'Subtes berhasil diperbarui');
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();

        return redirect()->route('exams.index')->with('success', 'Subtes berhasil dihapus');
    }
}
