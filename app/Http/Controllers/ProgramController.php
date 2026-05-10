<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramSubtestWeight;
use App\Models\Subtest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::withCount('programSubtestWeights')->latest()->get();

        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        $subtests = Subtest::orderBy('name')->get();

        return view('admin.programs.create', compact('subtests'));
    }

    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $validated = $this->validateProgramRequest($request);

            $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

            $program = Program::create([
                'name' => $validated['name'],
                'slug' => $validated['slug'],
                'description' => $validated['description'] ?? null,
                'is_active' => $request->boolean('is_active'),
                'capacity' => $validated['capacity'] ?? 0,
                'portfolio_required' => $request->boolean('portfolio_required'),
                'portfolio_description' => $validated['portfolio_description'] ?? null,
                'portfolio_weight' => $validated['portfolio_weight'] ?? 0,
            ]);

            $this->syncWeights($program, $validated['weights'] ?? []);

            return redirect()->route('programs.index')->with('success', 'Program berhasil ditambahkan');
        });
    }

    public function show(Program $program)
    {
        $program->load('programSubtestWeights.subtest');

        return view('admin.programs.show', compact('program'));
    }

    public function edit(Program $program)
    {
        $subtests = Subtest::orderBy('name')->get();
        $program->load('programSubtestWeights');

        return view('admin.programs.edit', compact('program', 'subtests'));
    }

    public function update(Request $request, Program $program)
    {
        return DB::transaction(function () use ($request, $program) {
            $validated = $this->validateProgramRequest($request);

            $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

            $program->update([
                'name' => $validated['name'],
                'slug' => $validated['slug'],
                'description' => $validated['description'] ?? null,
                'is_active' => $request->boolean('is_active'),
                'capacity' => $validated['capacity'] ?? 0,
                'portfolio_required' => $request->boolean('portfolio_required'),
                'portfolio_description' => $validated['portfolio_description'] ?? null,
                'portfolio_weight' => $validated['portfolio_weight'] ?? 0,
            ]);

            $this->syncWeights($program, $validated['weights'] ?? []);

            return redirect()->route('programs.index')->with('success', 'Program berhasil diperbarui');
        });
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
            ->map(function ($weight, $subtestId) use ($program) {
                return [
                    'program_id' => $program->id,
                    'subtest_id' => (int) $subtestId,
                    'weight' => (float) $weight,
                ];
            })
            ->values()
            ->all();

        $total = array_sum(array_column($filtered, 'weight'));
        $expectedTotal = max(0, 100.00 - (float) $program->portfolio_weight);

        if (count($filtered) > 0 && round($total, 2) !== round($expectedTotal, 2)) {
            throw ValidationException::withMessages([
                'weights' => [sprintf('Total bobot subtes harus %s%%.', number_format($expectedTotal, 2))],
            ]);
        }

        // hapus dulu (biar clean seperti sync)
        $program->programSubtestWeights()->delete();

        // insert ulang
        ProgramSubtestWeight::insert($filtered);
    }

    protected function validateProgramRequest(Request $request): array
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:programs,slug' . ($request->route('program') ? ',' . $request->route('program')->id : ''),
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'capacity' => 'nullable|integer|min:0',
            'portfolio_required' => 'boolean',
            'portfolio_description' => 'nullable|string',
            'portfolio_weight' => 'nullable|numeric|min:0|max:100',
            'weights' => 'nullable|array',
            'weights.*' => 'nullable|numeric|min:0|max:100',
        ]);

        $portfolioRequired = $request->boolean('portfolio_required');

        if ($portfolioRequired) {
            if (! $request->filled('portfolio_weight')) {
                throw ValidationException::withMessages([
                    'portfolio_weight' => ['Bobot portofolio wajib diisi ketika portofolio diaktifkan.'],
                ]);
            }
        } else {
            if ($request->filled('portfolio_description')) {
                throw ValidationException::withMessages([
                    'portfolio_description' => ['Deskripsi portofolio hanya boleh diisi jika portofolio diaktifkan.'],
                ]);
            }

            if ($request->filled('portfolio_weight')) {
                throw ValidationException::withMessages([
                    'portfolio_weight' => ['Bobot portofolio harus kosong ketika portofolio tidak diaktifkan.'],
                ]);
            }

            $validated['portfolio_description'] = null;
            $validated['portfolio_weight'] = 0;
        }

        return $validated;
    }
}
