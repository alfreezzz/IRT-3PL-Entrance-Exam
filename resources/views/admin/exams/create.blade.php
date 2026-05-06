@extends('layouts.app')

@section('title', 'Tambah Subtes')

@section('content')
<x-form.form-card title="Tambah Subtes" :backUrl="route('exams.index')">
    <form action="{{ route('exams.store') }}" method="POST" class="space-y-6">
        @csrf

        <x-form.input
            label="Judul"
            name="title"
            placeholder="Contoh: Matematika Dasar"
            :value="old('title')"
            required
        />

        <x-form.textarea
            label="Deskripsi"
            name="description"
            placeholder="Deskripsi singkat subtes"
            :value="old('description')"
            rows="4"
        />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-form.input
                label="Mulai"
                type="datetime-local"
                name="start_time"
                :value="old('start_time')"
                required
            />

            <x-form.input
                label="Selesai"
                type="datetime-local"
                name="end_time"
                :value="old('end_time')"
                required
            />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-form.input
                label="Durasi (menit)"
                type="number"
                name="duration"
                placeholder="0"
                :value="old('duration')"
                required
                min="0"
            />

            <x-form.input
                label="Tahun"
                type="number"
                name="year"
                placeholder="2026"
                :value="old('year', now()->year)"
                required
                min="2000"
            />
        </div>

        <x-form.form-actions :cancelUrl="route('exams.index')" />
    </form>
</x-form.form-card>
@endsection
