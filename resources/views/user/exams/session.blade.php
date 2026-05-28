@extends('layouts.app')

@section('title', 'Ujian Full Session')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">
        @if(session('error'))
            <div class="rounded-3xl border border-red-200 bg-red-50 p-5 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <div class="rounded-3xl bg-white dark:bg-slate-900 p-8 shadow-sm border border-slate-200/70 dark:border-slate-800">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">Ujian Full Session</p>
                    <h1 class="mt-2 text-3xl font-semibold text-slate-900 dark:text-slate-100">Mulai Sesi Ujian</h1>
                    <p class="mt-3 text-slate-600 dark:text-slate-300">Anda akan mengerjakan semua exam yang tersedia saat ini secara acak. Durasi setiap exam berjalan penuh dan tidak boleh submit sebelum waktu selesai.</p>
                </div>
                <div class="rounded-3xl bg-slate-50 dark:bg-slate-800 p-5 text-slate-900 dark:text-slate-100">
                    <p class="text-sm text-slate-500">Exam tersedia saat ini</p>
                    <p class="mt-2 text-3xl font-semibold">{{ $availableExams->count() }}</p>
                </div>
            </div>

            <div class="mt-8 space-y-5">
                @if($availableExams->isEmpty())
                    <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5 text-amber-800">
                        Tidak ada ujian yang sedang berjalan. Silakan kembali nanti.
                    </div>
                @else
                    <div class="grid gap-4 sm:grid-cols-2">
                        @foreach($availableExams as $exam)
                            <div class="rounded-3xl border border-slate-200/70 bg-white dark:bg-slate-950 p-5 shadow-sm dark:border-slate-800">
                                <p class="text-sm font-medium text-slate-600 dark:text-slate-300">{{ $exam->title }}</p>
                                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">{{ $exam->description ?? 'Tidak ada deskripsi.' }}</p>
                                <div class="mt-4 text-sm text-slate-500 dark:text-slate-400 space-y-2">
                                    <p><strong>Durasi:</strong> {{ $exam->duration }} menit</p>
                                    <p><strong>Mulai:</strong> {{ $exam->start_time->format('d M Y H:i') }}</p>
                                    <p><strong>Selesai:</strong> {{ $exam->end_time->format('d M Y H:i') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 border-t border-slate-200/70 dark:border-slate-700 pt-8">
                        <div class="rounded-3xl border border-blue-200 bg-blue-50 dark:bg-blue-950/40 p-6 dark:border-blue-900">
                            <p class="font-semibold text-slate-900 dark:text-slate-100">Aturan penting</p>
                            <ul class="mt-3 space-y-2 text-sm text-slate-600 list-disc list-inside dark:text-slate-300">
                                <li>Semua exam dipilih berdasarkan waktu yang sedang berjalan.</li>
                                <li>Urutan exam akan diacak setiap sesi.</li>
                                <li>Mode full screen diperlukan dan Anda tidak boleh berpindah tab.</li>
                                <li>Submit hanya tersedia setelah durasi masing-masing exam selesai.</li>
                            </ul>
                        </div>

                        <form class="mt-8" method="POST" action="{{ route('user.exams.session.start') }}">
                            @csrf
                            <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                                Mulai Ujian Sekarang
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
