@extends('layouts.app')

@section('title', 'Detail Soal')

@section('content')
<x-page-header
    title="Detail Soal"
    subtitle="Kelola pilihan jawaban dan ubah teks soal"
    action-label="Tambah Pilihan"
    :action-url="route('questions.options.create', $question)"
/>

@if(session('success'))
    <x-alert type="success" :message="session('success')" />
@endif

<div class="grid gap-6 lg:grid-cols-[1.5fr_1fr]">
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700/50 dark:bg-slate-950">
        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Pertanyaan</h2>
        <div class="ql-content text-slate-700 dark:text-slate-300">{!! $question->question_text !!}</div>
    </div>
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700/50 dark:bg-slate-950">
        <div class="flex flex-col gap-3">
            <a href="{{ route('exams.show', $exam) }}" class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-slate-900 dark:text-slate-300 dark:hover:text-white">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke Subtes
            </a>
            <a href="{{ route('exams.questions.edit', [$exam, $question]) }}" class="inline-flex items-center justify-center rounded-full border border-amber-200 bg-amber-50 px-4 py-2 text-sm font-medium text-amber-700 hover:bg-amber-100 dark:border-amber-700/40 dark:bg-amber-900/30 dark:text-amber-200">
                Edit Soal
            </a>
        </div>
        <div class="mt-6 space-y-4">
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700/50 dark:bg-slate-900">
                <p class="text-sm text-slate-500">Subtes</p>
                <p class="font-medium text-slate-900 dark:text-white">{{ $exam->title }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700/50 dark:bg-slate-900">
                <p class="text-sm text-slate-500">Tahun</p>
                <p class="font-medium text-slate-900 dark:text-white">{{ $exam->year }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700/50 dark:bg-slate-900">
                <p class="text-sm text-slate-500">Jumlah Pilihan</p>
                <p class="font-medium text-slate-900 dark:text-white">{{ $question->options->count() }}</p>
            </div>
        </div>
    </div>
</div>

<div class="mt-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700/50 dark:bg-slate-950">
    <div class="flex items-center justify-between gap-4">
        <div>
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Pilihan Jawaban</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400">Kelola pilihan ganda untuk soal ini.</p>
        </div>
        <a href="{{ route('questions.options.create', $question) }}" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-white transition hover:bg-blue-700">
            Tambah Pilihan
        </a>
    </div>

    @php
        $columns = [
            [
                'label' => 'No',
                'render' => fn($item, $key) => $key + 1,
            ],
            [
                'label' => 'Pilihan',
                'key' => 'option_text',
                'render' => fn($item) => $item->option_text,
            ],
            [
                'label' => 'Benar',
                'render' => fn($item) => $item->is_correct ? 'Ya' : 'Tidak',
            ],
        ];

        $actions = fn($item) => view('components.table.table-row-actions', [
            'editUrl' => route('options.edit', $item),
            'deleteUrl' => route('options.destroy', $item),
            'deleteMessage' => 'Yakin ingin menghapus pilihan ini?',
        ])->render();
    @endphp

    <div class="mt-6">
        <x-table.data-table
            :items="$question->options"
            :columns="$columns"
            :actions="$actions"
            emptyMessage="Belum ada pilihan untuk soal ini"
        />
    </div>
</div>
@endsection
