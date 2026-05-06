@extends('layouts.app')

@section('title', 'Subtes')

@section('content')
<x-page-header 
    title="Subtes"
    subtitle="Kelola daftar subtes untuk setiap tahun ajaran"
    action-label="Tambah Subtes"
    :action-url="route('exams.create')"
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
            'label' => 'Judul',
            'key' => 'title',
            'sortable' => true,
        ],
        [
            'label' => 'Tahun',
            'render' => fn($item) => $item->year ?? '-',
        ],
        [
            'label' => 'Durasi',
            'render' => fn($item) => $item->duration . ' menit',
        ],
        [
            'label' => 'Mulai',
            'key' => 'start_time',
            'sortable' => true,
            'render' => fn($item) => $item->start_time->format('d M Y, H:i'),
        ],
        [
            'label' => 'Selesai',
            'key' => 'end_time',
            'sortable' => true,
            'render' => fn($item) => $item->end_time->format('d M Y, H:i'),
        ],
    ];

    $actions = fn($item) => view('components.table.table-row-actions', [
        'showUrl' => route('exams.show', $item->id),
        'editUrl' => route('exams.edit', $item->id),
        'deleteUrl' => route('exams.destroy', $item->id),
        'deleteMessage' => 'Yakin ingin menghapus subtes ini?',
    ])->render();
@endphp

<x-table.data-table 
    :items="$exams"
    :columns="$columns"
    :actions="$actions"
    emptyMessage="Tidak ada subtes"
/>
@endsection
