@extends('layouts.app')

@section('title', 'Edit Pilihan')

@section('content')
<x-form.form-card title="Edit Pilihan" :backUrl="route('exams.questions.show', [$option->question->exam, $option->question])">
    <form action="{{ route('options.update', $option) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <x-form.editor
            name="option_text"
            placeholder="Tuliskan teks pilihan di sini"
            :value="old('option_text', $option->option_text)"
        />

        <x-form.checkbox
            label="Tandai sebagai jawaban benar"
            name="is_correct"
            :checked="old('is_correct', $option->is_correct)"
        />

        <x-form.form-actions :cancelUrl="route('exams.questions.show', [$option->question->exam, $option->question])" />
    </form>
</x-form.form-card>
@endsection
