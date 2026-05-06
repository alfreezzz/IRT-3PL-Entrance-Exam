@extends('layouts.app')

@section('title', 'Edit Soal')

@section('content')
<x-form.form-card title="Edit Soal" :backUrl="route('exams.show', $exam)">
    <form action="{{ route('exams.questions.update', [$exam, $question]) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <x-form.editor
            name="question_text"
            placeholder="Tuliskan pertanyaan di sini"
            :value="old('question_text', $question->question_text)"
        />

        <x-form.form-actions :cancelUrl="route('exams.show', $exam)" />
    </form>
</x-form.form-card>
@endsection
