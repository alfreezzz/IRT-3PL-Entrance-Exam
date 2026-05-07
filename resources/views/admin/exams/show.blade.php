@extends('layouts.app')

@section('title', 'Detail Ujian')

@section('content')
<x-page-header
    title="Detail Ujian"
    subtitle="Informasi lengkap subtes"
    action-label="Edit Ujian"
    :action-url="route('exams.edit', $exam->id)"
/>

@if(session('success'))
    <x-alert type="success" :message="session('success')" />
@endif

<div class="grid gap-6 lg:grid-cols-[1.5fr_1fr]">
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700/50 dark:bg-slate-950">
        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">{{ $exam->title }}</h2>
        <p class="mt-4 text-sm text-slate-500 dark:text-slate-400">{{ $exam->description ?? 'Tidak ada deskripsi subtes.' }}</p>

        <div class="mt-6 grid gap-4 sm:grid-cols-2">
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700/50 dark:bg-slate-900">
                <p class="text-sm text-slate-500">Tahun</p>
                <p class="font-medium text-slate-900 dark:text-white">{{ $exam->year }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700/50 dark:bg-slate-900">
                <p class="text-sm text-slate-500">Durasi</p>
                <p class="font-medium text-slate-900 dark:text-white">{{ $exam->duration }} menit</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700/50 dark:bg-slate-900">
                <p class="text-sm text-slate-500">Mulai</p>
                <p class="font-medium text-slate-900 dark:text-white">{{ $exam->start_time->format('d M Y, H:i') }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700/50 dark:bg-slate-900">
                <p class="text-sm text-slate-500">Selesai</p>
                <p class="font-medium text-slate-900 dark:text-white">{{ $exam->end_time->format('d M Y, H:i') }}</p>
            </div>
        </div>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700/50 dark:bg-slate-950">
        <div class="space-y-4">
            <div>
                <p class="text-sm text-slate-500">Total Soal</p>
                <p class="text-2xl font-semibold text-slate-900 dark:text-white">{{ $exam->questions->count() }}</p>
            </div>
            <div>
                <p class="text-sm text-slate-500">Waktu</p>
                <p class="text-slate-900 dark:text-white">{{ $exam->duration }} menit</p>
            </div>
            <div>
                <p class="text-sm text-slate-500">Ujian Dibuat</p>
                <p class="text-slate-900 dark:text-white">{{ $exam->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i') }}</p>
            </div>
        </div>
    </div>
</div>

<div class="mt-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700/50 dark:bg-slate-950">
    <div class="flex items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Daftar Soal</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">Kelola semua soal yang termasuk dalam subtes ini.</p>
        </div>
        <a href="{{ route('exams.questions.create', $exam) }}" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-white transition hover:bg-blue-700">
            Tambah Soal
        </a>
    </div>

    @php
        $columns = [
            [
                'label' => 'No',
                'render' => fn($item, $key) => $key + 1,
            ],
            [
                'label' => 'Soal',
                'render' => fn($item) => \Illuminate\Support\Str::limit($item->question_text, 80),
            ],
            [
                'label' => 'Tipe Soal',
                'render' => fn($item) => str_replace('_', ' ', ucfirst($item->question_type)),
            ],
             [
                'label' => 'Pilihan',
                'render' => fn($item) => $item->options->count() > 0 ? $item->options->count() : '-',
            ],
        ];

        $actions = fn($item) => view('components.table.table-row-actions', [
            'showUrl' => route('exams.questions.show', [$exam, $item]),
            'editUrl' => route('exams.questions.edit', [$exam, $item]),
            'deleteUrl' => route('exams.questions.destroy', [$exam, $item]),
            'deleteMessage' => 'Yakin ingin menghapus soal ini? Semua pilihan juga akan terhapus.',
        ])->render();
    @endphp

    <x-table.data-table
        :items="$exam->questions"
        :columns="$columns"
        :actions="$actions"
        emptyMessage="Belum ada soal untuk subtes ini"
    />
</div>
@endsection
