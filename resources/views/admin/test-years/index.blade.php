@extends('layouts.app')

@section('title', 'Tahun Ajaran')

@section('content')
<x-page-header 
    title="Tahun Ajaran"
    subtitle="Kelola periode tahun ajaran untuk subtes dan ujian"
    action-label="Tambah Tahun Ajaran"
    :action-url="route('test-years.create')"
/>

@if(session('success'))
    <x-alert type="success" :message="session('success')" />
@endif

@php
    $columns = [
        [
            'label' => 'No',
            'render' => fn($item, $key) => $key + 1,
        ],
        [
            'label' => 'Periode',
            'render' => fn($item) => $item->start_year . ' / ' . $item->end_year,
        ],
        [
            'label' => 'Aktif',
            'render' => fn($item) => view('components.badge', [
                'color' => $item->is_active ? 'green' : 'red',
            ])->with('slot', $item->is_active ? 'Ya' : 'Tidak')->render(),
        ],
        [
            'label' => 'Dibuat',
            'key' => 'created_at',
            'sortable' => true,
            'render' => fn($item) => $item->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i'),
        ],
    ];

    $actions = fn($item) => view('components.table.table-row-actions', [
        'showUrl' => route('test-years.show', $item->id),
        'editUrl' => route('test-years.edit', $item->id),
        'deleteUrl' => route('test-years.destroy', $item->id),
        'deleteMessage' => 'Yakin ingin menghapus tahun ajaran ini?',
    ])->render();
@endphp

<x-table.data-table 
    :items="$testYears"
    :columns="$columns"
    :actions="$actions"
    emptyMessage="Tidak ada tahun ajaran"
/>
@endsection
