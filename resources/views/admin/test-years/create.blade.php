@extends('layouts.app')

@section('title', 'Tambah Tahun Ajaran')

@section('content')
<x-form.form-card title="Tambah Tahun Ajaran" :backUrl="route('test-years.index')">
    <form action="{{ route('test-years.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-form.input
                label="Tahun Mulai"
                name="start_year"
                type="number"
                placeholder="2026"
                :value="old('start_year')"
                required
                min="1900"
                max="2100"
            />

            <x-form.input
                label="Tahun Selesai"
                name="end_year"
                type="number"
                placeholder="2027"
                :value="old('end_year')"
                required
                min="1900"
                max="2100"
            />
        </div>

        <x-form.checkbox
            label="Aktif"
            name="is_active"
            :checked="old('is_active', true)"
        />

        <x-form.form-actions :cancelUrl="route('test-years.index')" />
    </form>
</x-form.form-card>
@endsection
