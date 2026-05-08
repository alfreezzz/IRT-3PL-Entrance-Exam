@extends('layouts.app')

@section('title', 'Subtes')

@section('content')
<x-page-header 
    title="Subtes"
    subtitle="Kelola daftar subtes untuk setiap tahun ajaran"
    action-label="Tambah Subtes"
    :action-url="route('subtests.create')"
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
            'label' => 'Nama',
            'key' => 'name',
            'sortable' => true,
        ],
        [
            'label' => 'Deskripsi',
            'key' => 'description',
            'render' => fn($item) => substr($item->description ?? '-', 0, 50) . (strlen($item->description ?? '') > 50 ? '...' : ''),
        ],
        [
            'label' => 'Tanggal Dibuat',
            'key' => 'created_at',
            'sortable' => true,
            'render' => fn($item) => $item->created_at->format('d M Y, H:i'),
        ],
    ];

    $actions = fn($item) => view('components.table.table-row-actions', [
        'showUrl' => route('subtests.show', $item->id),
        'editUrl' => route('subtests.edit', $item->id),
        'deleteUrl' => route('subtests.destroy', $item->id),
        'deleteMessage' => 'Yakin ingin menghapus subtes ini?',
    ])->render();
@endphp

<x-table.data-table 
    :items="$subtests"
    :columns="$columns"
    :actions="$actions"
    emptyMessage="Tidak ada subtes"
/>
@endsection
