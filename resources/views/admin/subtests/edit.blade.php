@extends('layouts.app')

@section('title', 'Edit Subtes')

@section('content')
<x-form.form-card title="Edit Subtes" :backUrl="route('subtests.index')">
    <form action="{{ route('subtests.update', $subtest->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <x-form.input
            label="Nama"
            name="name"
            placeholder="Contoh: Matematika Dasar"
            :value="old('name', $subtest->name)"
            required
        />

        <x-form.textarea
            label="Deskripsi"
            name="description"
            placeholder="Deskripsi singkat subtes"
            :value="old('description', $subtest->description)"
            rows="4"
        />

        <x-form.form-actions :cancelUrl="route('subtests.index')" />
    </form>
</x-form.form-card>
@endsection
