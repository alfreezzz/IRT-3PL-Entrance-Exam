@extends('layouts.app')

@section('title', 'Tambah Subtes')

@section('content')
<x-form.form-card title="Tambah Subtes" :backUrl="route('subtests.index')">
    <form action="{{ route('subtests.store') }}" method="POST" class="space-y-6">
        @csrf

        <x-form.input
            label="Nama"
            name="name"
            placeholder="Contoh: Matematika Dasar"
            :value="old('name')"
            required
        />

        <x-form.textarea
            label="Deskripsi"
            name="description"
            placeholder="Deskripsi singkat subtes"
            :value="old('description')"
            rows="4"
        />

        <x-form.form-actions :cancelUrl="route('subtests.index')" />
    </form>
</x-form.form-card>
@endsection
