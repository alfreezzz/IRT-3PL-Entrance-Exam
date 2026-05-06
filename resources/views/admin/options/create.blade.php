@extends('layouts.app')

@section('title', 'Tambah Pilihan')

@section('content')
<x-form.form-card title="Tambah Pilihan" :backUrl="route('exams.questions.show', [$question->exam, $question])">
    <form action="{{ route('questions.options.store', $question) }}" method="POST" class="space-y-6">
        @csrf

        <x-form.editor
            name="option_text"
            placeholder="Tuliskan teks pilihan di sini"
            :value="old('option_text')"
        />

        <x-form.checkbox
            label="Tandai sebagai jawaban benar"
            name="is_correct"
            :checked="old('is_correct', false)"
        />

        <x-form.form-actions :cancelUrl="route('exams.questions.show', [$question->exam, $question])" />
    </form>
</x-form.form-card>
@endsection
