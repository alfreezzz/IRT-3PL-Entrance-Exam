<?php

namespace App\Http\Controllers;

use App\Models\Subtest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubtestController extends Controller
{
    public function index()
    {
        $subtests = Subtest::latest()->get();

        return view('admin.subtests.index', compact('subtests'));
    }

    public function create()
    {
        return view('admin.subtests.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:subtests,slug',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        Subtest::create($validated);

        return redirect()->route('subtests.index')->with('success', 'Subtes berhasil ditambahkan');
    }


    public function show(Subtest $subtest)
    {
        return view('admin.subtests.show', compact('subtest'));
    }

    public function edit(Subtest $subtest)
    {
        return view('admin.subtests.edit', compact('subtest'));
    }

    public function update(Request $request, Subtest $subtest)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:subtests,slug,' . $subtest->id,
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        $subtest->update($validated);

        return redirect()->route('subtests.index')->with('success', 'Subtes berhasil diperbarui');
    }

    public function destroy(Subtest $subtest)
    {
        $subtest->delete();

        return redirect()->route('subtests.index')->with('success', 'Subtes berhasil dihapus');
    }
}
