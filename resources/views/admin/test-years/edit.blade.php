@extends('layouts.app')

@section('title', 'Edit Tahun Ajaran')

@section('content')
<x-form.form-card title="Edit Tahun Ajaran" :backUrl="route('test-years.index')">
    <form action="{{ route('test-years.update', $academicYear->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-form.input
                label="Tahun Mulai"
                name="start_year"
                type="number"
                placeholder="2026"
                :value="old('start_year', $academicYear->start_year)"
                required
                min="1900"
                max="2100"
            />

            <x-form.input
                label="Tahun Selesai"
                name="end_year"
                type="number"
                placeholder="2027"
                :value="old('end_year', $academicYear->end_year)"
                required
                min="1900"
                max="2100"
            />
        </div>

        <x-form.checkbox
            label="Aktif"
            name="is_active"
            :checked="old('is_active', $academicYear->is_active)"
        />

        <x-form.form-actions :cancelUrl="route('test-years.index')" />
    </form>
</x-form.form-card>
@endsection
