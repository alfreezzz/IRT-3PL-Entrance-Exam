@extends('layouts.app')

@section('title', 'Program Studi')

@section('content')
<x-page-header 
    title="Program Studi"
    subtitle="Kelola program studi dan bobot subtes untuk setiap program"
    action-label="Tambah Program"
    :action-url="route('programs.create')"
/>

@if(session('success'))
    <x-alert type="success" :message="session('success')" />
@endif

@php
    $columns = [
        [
            'label' => 'No',
            'render' => fn($program, $key) => $key + 1,
        ],
        [
            'label' => 'Nama Program',
            'key' => 'name',
            'sortable' => true,
            'render' => fn($program) => "<span class='font-medium text-slate-900 dark:text-white'>" . e($program->name) . "</span>",
        ],
        [
            'label' => 'Subtes Terdaftar',
            'render' => fn($program) => $program->program_subtest_weights_count,
        ],
        [
            'label' => 'Aktif',
            'render' => fn($program) => view('components.badge', [
                'color' => $program->is_active ? 'green' : 'red',
            ])->with('slot', $program->is_active ? 'Ya' : 'Tidak')->render(),
        ],
        [
            'label' => 'Portofolio',
            'render' => fn($program) => view('components.badge', [
                'color' => $program->portfolio_required ? 'amber' : 'slate',
            ])->with('slot', $program->portfolio_required ? 'Wajib' : 'Tidak')->render(),
        ],
        [
            'label' => 'Tanggal Dibuat',
            'key' => 'created_at',
            'sortable' => true,
            'render' => fn($program) => $program->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i'),
        ],
    ];

    $actions = fn($program) => view('components.table.table-row-actions', [
        'showUrl' => route('programs.show', $program->id),
        'editUrl' => route('programs.edit', $program->id),
        'deleteUrl' => route('programs.destroy', $program->id),
        'deleteMessage' => 'Yakin ingin menghapus program ini?',
    ])->render();
@endphp

<x-table.data-table 
    :items="$programs"
    :columns="$columns"
    :actions="$actions"
    emptyMessage="Tidak ada program studi"
/>
@endsection
