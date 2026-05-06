@extends('layouts.app')

@section('title', 'Edit Subtes')

@section('content')
<x-form.form-card title="Edit Subtes" :backUrl="route('exams.index')">
    <form action="{{ route('exams.update', $exam->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <x-form.input
            label="Judul"
            name="title"
            placeholder="Contoh: Matematika Dasar"
            :value="old('title', $exam->title)"
            required
        />

        <x-form.textarea
            label="Deskripsi"
            name="description"
            placeholder="Deskripsi singkat subtes"
            :value="old('description', $exam->description)"
            rows="4"
        />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-form.input
                label="Mulai"
                type="datetime-local"
                name="start_time"
                :value="old('start_time', $exam->start_time?->format('Y-m-d\TH:i'))"
                required
            />

            <x-form.input
                label="Selesai"
                type="datetime-local"
                name="end_time"
                :value="old('end_time', $exam->end_time?->format('Y-m-d\TH:i'))"
                required
            />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-form.input
                label="Durasi (menit)"
                type="number"
                name="duration"
                placeholder="0"
                :value="old('duration', $exam->duration)"
                required
                min="0"
            />

            <x-form.input
                label="Tahun"
                type="number"
                name="year"
                placeholder="2026"
                :value="old('year', $exam->year)"
                required
                min="2000"
            />
        </div>

        <x-form.form-actions :cancelUrl="route('exams.index')" />
    </form>
</x-form.form-card>
@endsection
