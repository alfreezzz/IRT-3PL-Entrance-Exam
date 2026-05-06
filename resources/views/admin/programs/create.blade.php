@extends('layouts.app')

@section('title', 'Tambah Program Studi')

@section('content')
<x-form.form-card title="Tambah Program Studi" :backUrl="route('programs.index')">
    <form action="{{ route('programs.store') }}" method="POST" class="space-y-6">
        @csrf

        <x-form.input
            label="Nama Program"
            name="name"
            placeholder="Masukkan nama program studi"
            :value="old('name')"
            required
            x-model="name"
            @input="onNameChange()"
        />

        <x-form.textarea
            label="Deskripsi Program"
            name="description"
            placeholder="Deskripsi singkat program studi"
            :value="old('description')"
            rows="4"
        />

        <x-form.checkbox
            label="Aktif"
            name="is_active"
            :checked="old('is_active', true)"
        />

        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6 dark:border-slate-700/50 dark:bg-slate-900">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Bobot Subtes</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Masukkan bobot (%) untuk setiap subtes. Total harus 100%.</p>

            @error('weights')
                <div class="mt-4 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    {{ $message }}
                </div>
            @enderror

            @if($exams->isEmpty())
                <p class="mt-4 text-sm text-amber-500">Belum ada subtes/ujian. Tambahkan subtes terlebih dahulu.</p>
            @endif

            <div class="mt-6 space-y-4">
                @foreach($exams as $exam)
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-[1fr_180px] md:items-center">
                        <div>
                            <p class="font-medium text-slate-700 dark:text-slate-100">{{ $exam->title . ' (' . $exam->year . ')' }}</p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $exam->description ?? 'Tidak ada deskripsi' }}</p>
                        </div>

                        <x-form.input
                            label="Bobot (%)"
                            name="weights[{{ $exam->id }}]"
                            type="number"
                            placeholder="0"
                            step="0.01"
                            min="0"
                            max="100"
                            :value="old('weights.' . $exam->id)"
                        />
                    </div>
                @endforeach
            </div>
        </div>

        <x-form.form-actions :cancelUrl="route('programs.index')" />
    </form>
</x-form.form-card>
@endsection
