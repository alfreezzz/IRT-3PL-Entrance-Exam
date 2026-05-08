@extends('layouts.app')

@section('title', 'Edit Program Studi')

@section('content')
<x-form.form-card title="Edit Program Studi" :backUrl="route('programs.index')">
    <form action="{{ route('programs.update', $program->id) }}" method="POST" class="space-y-6" x-data="{ portfolioRequired: @json((bool) old('portfolio_required', $program->portfolio_required)) }">
        @csrf
        @method('PUT')

        <x-form.input
            label="Nama Program"
            name="name"
            placeholder="Masukkan nama program studi"
            :value="old('name', $program->name)"
            required
            x-model="name"
            @input="onNameChange()"
        />

        <x-form.textarea
            label="Deskripsi Program"
            name="description"
            placeholder="Deskripsi singkat program studi"
            :value="old('description', $program->description)"
            rows="4"
        />

        <x-form.checkbox
            label="Aktif"
            name="is_active"
            :checked="old('is_active', $program->is_active)"
        />

        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6 dark:border-slate-700/50 dark:bg-slate-900">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Pengaturan Portofolio</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Atur apakah portofolio diperlukan untuk program ini dan berapa bobotnya.</p>

            <div class="mt-6 space-y-4">
                <x-form.checkbox
                    label="Portofolio Wajib"
                    name="portfolio_required"
                    :checked="old('portfolio_required', $program->portfolio_required)"
                    x-model="portfolioRequired"
                />

                <div x-show="portfolioRequired" x-cloak class="space-y-4">
                    <x-form.textarea
                        label="Deskripsi Portofolio"
                        name="portfolio_description"
                        placeholder="Deskripsikan jenis portofolio yang diminta"
                        :value="old('portfolio_description', $program->portfolio_description)"
                        rows="4"
                        x-bind:disabled="!portfolioRequired"
                    />

                    <x-form.input
                        label="Bobot Portofolio (%)"
                        name="portfolio_weight"
                        type="number"
                        placeholder="0"
                        step="0.01"
                        min="0"
                        max="100"
                        :value="old('portfolio_weight', $program->portfolio_weight)"
                        x-bind:disabled="!portfolioRequired"
                    />
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6 dark:border-slate-700/50 dark:bg-slate-900">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Bobot Subtes</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Masukkan bobot (%) untuk setiap subtes. Total bobot subtes harus sama dengan 100% dikurangi bobot portofolio.</p>

            @error('weights')
                <div class="mt-4 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    {{ $message }}
                </div>
            @enderror

            <div class="mt-6 space-y-4">
                @foreach($subtests as $subtest)
                    @php
                        $weight = old('weights.' . $subtest->id, optional($program->programSubtestWeights->firstWhere('subtest_id', $subtest->id))->weight);
                    @endphp
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-[1fr_180px] md:items-center">
                        <div>
                            <p class="font-medium text-slate-700 dark:text-slate-100">{{ $subtest->name }}</p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $subtest->description ?? 'Tidak ada deskripsi' }}</p>
                        </div>

                        <x-form.input
                            label="Bobot (%)"
                            name="weights[{{ $subtest->id }}]"
                            type="number"
                            placeholder="0"
                            step="0.01"
                            min="0"
                            max="100"
                            :value="$weight"
                        />
                    </div>
                @endforeach
            </div>
        </div>

        <x-form.form-actions :cancelUrl="route('programs.index')" />
    </form>
</x-form.form-card>
@endsection
