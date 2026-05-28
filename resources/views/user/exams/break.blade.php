@extends('layouts.app')

@section('title', 'Istirahat Sebelum Ujian Berikutnya')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="rounded-3xl bg-white dark:bg-slate-900 p-8 shadow-sm border border-slate-200/70 dark:border-slate-800">
            <h1 class="text-3xl font-semibold text-slate-900 dark:text-slate-100">Istirahat Sebentar</h1>
            <p class="mt-4 text-slate-600 dark:text-slate-300">Anda akan melanjutkan ke exam berikutnya setelah jeda 1 menit berakhir. Harap tetap berada di halaman ini sampai lanjut otomatis.</p>

            <div class="mt-8 rounded-3xl border border-blue-200 bg-blue-50 dark:bg-blue-950/40 p-6 text-center">
                <p class="text-sm uppercase tracking-[0.2em] text-blue-500">Waktu istirahat</p>
                <p class="mt-4 text-5xl font-semibold text-blue-600" x-data="breakCountdown({{ $secondsRemaining }})" x-init="start()" x-text="formattedTime"></p>
                <p class="mt-3 text-sm text-slate-600 dark:text-slate-300">Halaman akan beralih ke ujian berikutnya secara otomatis.</p>
            </div>

            <div class="mt-8 rounded-3xl border border-slate-200/70 bg-slate-50 dark:bg-slate-800 p-6 text-slate-700 dark:text-slate-300">
                <p class="font-semibold">Exam berikutnya</p>
                <p class="mt-2 text-slate-600">{{ $session->currentExam?->title ?? 'Exam berikutnya belum tersedia.' }}</p>
                <p class="mt-1 text-sm text-slate-500">Durasi: {{ $session->currentExam?->duration ?? '-' }} menit</p>
            </div>
        </div>
    </div>

    <script>
        function breakCountdown(initialSeconds) {
            return {
                seconds: initialSeconds,
                start() {
                    setInterval(() => {
                        if (this.seconds > 0) {
                            this.seconds -= 1;
                        }

                        if (this.seconds === 0) {
                            window.location.href = '{{ route('user.exams.session.show', $session) }}';
                        }
                    }, 1000);
                },
                get formattedTime() {
                    const minutes = Math.floor(this.seconds / 60).toString().padStart(2, '0');
                    const seconds = (this.seconds % 60).toString().padStart(2, '0');
                    return `${minutes}:${seconds}`;
                }
            };
        }
    </script>
@endsection
