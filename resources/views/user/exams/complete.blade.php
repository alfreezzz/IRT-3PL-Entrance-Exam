@extends('layouts.app')

@section('title', 'Sesi Ujian Selesai')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">
        <div class="rounded-3xl bg-white dark:bg-slate-900 p-8 shadow-sm border border-slate-200/70 dark:border-slate-800">
            <h1 class="text-3xl font-semibold text-slate-900 dark:text-slate-100">Sesi Ujian Selesai</h1>
            <p class="mt-4 text-slate-600 dark:text-slate-300">Selamat, Anda telah menyelesaikan sesi ujian. Berikut ringkasan exam yang sudah dikerjakan.</p>

            <div class="mt-8 rounded-3xl border border-slate-200/70 bg-slate-50 dark:bg-slate-800 p-6">
                <p class="text-sm text-slate-500">Total exam selesai</p>
                <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $completedExams->count() }}</p>
                <p class="mt-4 text-sm text-slate-500">Sesi selesai pada {{ $session->completed_at?->format('d M Y H:i') ?? now()->format('d M Y H:i') }}</p>
            </div>

            <div class="mt-8 space-y-4">
                @foreach($completedExams as $participant)
                    <div class="rounded-3xl border border-slate-200 bg-white p-5">
                        <p class="text-base font-semibold text-slate-900">{{ $participant->exam->title }}</p>
                        <p class="mt-2 text-sm text-slate-600">Selesai pada {{ $participant->completed_at?->format('d M Y H:i') ?? '-' }}</p>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                <a href="{{ route('user.dashboard') }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
@endsection
