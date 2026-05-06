@extends('layouts.app')

@section('title', 'Tambah Soal')

@section('content')
<x-form.form-card title="Tambah Soal" :backUrl="route('exams.show', $exam)">
    <form action="{{ route('exams.questions.store', $exam) }}" method="POST" class="space-y-6">
        @csrf

        <x-form.editor
            name="question_text"
            placeholder="Tuliskan pertanyaan di sini"
            :value="old('question_text')"
        />

        <x-form.form-actions :cancelUrl="route('exams.show', $exam)" />
    </form>
</x-form.form-card>
@endsection
