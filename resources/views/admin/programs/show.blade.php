@extends('layouts.app')

@section('title', 'Detail Program Studi')

@section('content')
<x-page-header
    title="Program Studi"
    subtitle="Detail program studi dan bobot subtes"
    action-label="Edit Program"
    :action-url="route('programs.edit', $program->id)"
/>

<div class="grid gap-6">
    <div class="space-y-6">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700/50 dark:bg-slate-950">
            <h2 class="text-xl font-semibold text-slate-900 dark:text-white">{{ $program->name }}</h2>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">{{ $program->description ?? 'Tidak ada deskripsi program.' }}</p>

            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700/50 dark:bg-slate-900">
                    <p class="text-sm text-slate-500">Daya Tampung</p>
                    <p class="font-medium text-slate-900 dark:text-white">{{ $program->capacity }} peserta</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700/50 dark:bg-slate-900">
                    <p class="text-sm text-slate-500">Status</p>
                    <p class="font-medium text-slate-900 dark:text-white">{{ $program->is_active ? 'Aktif' : 'Tidak Aktif' }}</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700/50 dark:bg-slate-900">
                    <p class="text-sm text-slate-500">Portofolio</p>
                    <p class="font-medium text-slate-900 dark:text-white">{{ $program->portfolio_required ? 'Wajib' : 'Tidak Wajib' }}</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700/50 dark:bg-slate-900">
                    <p class="text-sm text-slate-500">Bobot Portofolio</p>
                    <p class="font-medium text-slate-900 dark:text-white">{{ number_format($program->portfolio_weight, 2) }}%</p>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700/50 dark:bg-slate-950">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Pengaturan Portofolio</h3>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Rincian persyaratan portofolio untuk program studi ini.</p>

            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700/50 dark:bg-slate-900">
                    <p class="text-sm text-slate-500">Diperlukan</p>
                    <p class="font-medium text-slate-900 dark:text-white">{{ $program->portfolio_required ? 'Ya' : 'Tidak' }}</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700/50 dark:bg-slate-900">
                    <p class="text-sm text-slate-500">Bobot Portofolio</p>
                    <p class="font-medium text-slate-900 dark:text-white">{{ number_format($program->portfolio_weight, 2) }}%</p>
                </div>
            </div>

            @if($program->portfolio_description)
                <div class="mt-6 rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700/50 dark:bg-slate-900">
                    <p class="text-sm text-slate-500">Deskripsi Portofolio</p>
                    <p class="mt-2 text-sm text-slate-700 dark:text-slate-300">{{ $program->portfolio_description }}</p>
                </div>
            @endif
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700/50 dark:bg-slate-950">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Bobot Subtes</h3>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Bobot yang terdaftar untuk setiap exam/subtes.</p>

            @if($program->programSubtestWeights->isEmpty())
                <p class="mt-4 text-sm text-slate-500">Belum ada bobot subtes yang diatur untuk program ini.</p>
            @else
                <div class="mt-6 grid gap-4">
                    @foreach($program->programSubtestWeights as $weight)
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700/50 dark:bg-slate-900">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="font-medium text-slate-900 dark:text-white">{{ $weight->subtest->name }}</p>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">{{ $weight->subtest->description ?? 'Tidak ada deskripsi' }}</p>
                                </div>
                                <span class="rounded-full bg-slate-900/5 px-3 py-1 text-sm font-semibold text-slate-900 dark:bg-slate-500/10 dark:text-slate-100">{{ number_format($weight->weight, 2) }}%</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
