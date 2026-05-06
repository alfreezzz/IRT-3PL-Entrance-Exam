<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\ProgramExamWeight;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::withCount('programExamWeights')->latest()->get();

        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        $exams = Exam::orderBy('title')->get();

        return view('admin.programs.create', compact('exams'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:programs,slug',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'weights' => 'nullable|array',
            'weights.*' => 'nullable|numeric|min:0|max:100',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        $program = Program::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'description' => $validated['description'] ?? null,
            'is_active' => $request->boolean('is_active'),
        ]);

        $this->syncWeights($program, $validated['weights'] ?? []);

        return redirect()->route('programs.index')->with('success', 'Program berhasil ditambahkan');
    }

    public function show(Program $program)
    {
        $program->load('programExamWeights.exam');

        return view('admin.programs.show', compact('program'));
    }

    public function edit(Program $program)
    {
        $exams = Exam::orderBy('title')->get();
        $program->load('programExamWeights');

        return view('admin.programs.edit', compact('program', 'exams'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:programs,slug,' . $program->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'weights' => 'nullable|array',
            'weights.*' => 'nullable|numeric|min:0|max:100',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        $program->update([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'description' => $validated['description'] ?? null,
            'is_active' => $request->boolean('is_active'),
        ]);

        $this->syncWeights($program, $validated['weights'] ?? []);

        return redirect()->route('programs.index')->with('success', 'Program berhasil diperbarui');
    }

    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('programs.index')->with('success', 'Program berhasil dihapus');
    }

    protected function syncWeights(Program $program, array $weights): void
    {
        $filtered = collect($weights)
            ->filter(fn($weight) => $weight !== null && $weight !== '' && (float) $weight >= 0)
            ->map(function ($weight, $examId) use ($program) {
                return [
                    'program_id' => $program->id,
                    'exam_id' => (int) $examId,
                    'weight' => (float) $weight,
                ];
            })
            ->values()
            ->all();

        $total = array_sum(array_column($filtered, 'weight'));

        if (count($filtered) > 0 && round($total, 2) !== 100.00) {
            throw ValidationException::withMessages([
                'weights' => ['Total bobot harus 100%.'],
            ]);
        }

        // hapus dulu (biar clean seperti sync)
        $program->programExamWeights()->delete();

        // insert ulang
        ProgramExamWeight::insert($filtered);
    }
}
