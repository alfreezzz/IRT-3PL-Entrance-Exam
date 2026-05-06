@extends('layouts.app')

@section('title', 'Detail Tahun Ajaran')

@section('content')
<x-page-header
    title="Detail Tahun Ajaran"
    subtitle="Informasi lengkap tahun ajaran"
    action-label="Edit Tahun Ajaran"
    :action-url="route('test-years.edit', $academicYear->id)"
/>

<div class="grid gap-6 lg:grid-cols-[1.5fr_1fr]">
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700/50 dark:bg-slate-950">
        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">{{ $academicYear->start_year }} / {{ $academicYear->end_year }}</h2>
        <p class="mt-4 text-sm text-slate-500 dark:text-slate-400">Periode tahun ajaran ini digunakan untuk pengelompokan subtes dan ujian.</p>

        <div class="mt-6 grid gap-4 sm:grid-cols-2">
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700/50 dark:bg-slate-900">
                <p class="text-sm text-slate-500">Tahun Mulai</p>
                <p class="font-medium text-slate-900 dark:text-white">{{ $academicYear->start_year }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700/50 dark:bg-slate-900">
                <p class="text-sm text-slate-500">Tahun Selesai</p>
                <p class="font-medium text-slate-900 dark:text-white">{{ $academicYear->end_year }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700/50 dark:bg-slate-900">
                <p class="text-sm text-slate-500">Status</p>
                <p class="font-medium text-slate-900 dark:text-white">{{ $academicYear->is_active ? 'Aktif' : 'Tidak Aktif' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
