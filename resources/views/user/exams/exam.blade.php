@extends('layouts.app')

@section('title', $exam->title)

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="rounded-3xl bg-white dark:bg-slate-900 p-8 shadow-sm border border-slate-200/70 dark:border-slate-800 text-center">
            <h1 class="text-2xl font-semibold text-slate-900 dark:text-slate-100 mb-4">Sistem Ujian Telah Diperbarui</h1>
            <p class="text-slate-600 dark:text-slate-300 mb-6">Sekarang Anda akan mengerjakan soal satu per satu dengan navigasi yang lebih baik.</p>
            @if($exam->questions->isNotEmpty())
                <a href="{{ route('user.exams.session.question', [$session, $exam->questions->first()]) }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                    Mulai Mengerjakan Soal
                </a>
            @else
                <p class="text-slate-500 dark:text-slate-400">Tidak ada soal tersedia.</p>
            @endif
        </div>
    </div>
@endsection
