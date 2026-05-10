@extends('layouts.app')

@section('title', 'Edit Soal')

@section('content')
<x-form.form-card title="Edit Soal" :backUrl="route('exams.show', $exam)">
    <form action="{{ route('exams.questions.update', [$exam, $question]) }}" method="POST" class="space-y-6"
        x-data="questionForm()">
        @csrf
        @method('PUT')

        @if($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 dark:border-red-800 dark:bg-red-900/20 p-4 text-sm text-red-700 dark:text-red-300">
                {{ $errors->first() }}
            </div>
        @endif

        <div @change="questionType = $event.target.value">
            <x-form.select
                label="Tipe Soal"
                name="question_type"
                :options="[
                    ['id' => 'short_answer', 'label' => 'Uraian Singkat'],
                    ['id' => 'single_choice', 'label' => 'Pilihan Ganda 1 Jawaban'],
                    ['id' => 'multiple_choice', 'label' => 'Pilihan Ganda Lebih dari 1 Jawaban'],
                    ['id' => 'true_false_table', 'label' => 'Tabel True/False'],
                ]"
                option-value="id"
                option-label="label"
                :value="old('question_type', $question->question_type)"
                placeholder="-- Pilih Tipe Soal --"
                required
            />
        </div>

        <x-form.editor
            name="question_text"
            placeholder="Tuliskan pertanyaan di sini"
            :value="old('question_text', $question->question_text)"
        />

        <div x-show="questionType === 'short_answer'" x-transition>
            <x-form.input
                label="Kunci Jawaban (Uraian Singkat)"
                type="number"
                name="answer_key"
                placeholder="Isi hanya jika tipe soal adalah uraian singkat"
                :value="old('answer_key', $question->answer_key)"
            />
        </div>

        <template x-if="questionType === 'true_false_table'">
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Pernyataan (3-5 pernyataan)</h3>
                    <button type="button" @click="addStatement" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="-ml-0.5 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Tambah Pernyataan
                    </button>
                </div>

                <template x-for="(statement, index) in statements" :key="index">
                    <div class="border border-gray-300 dark:border-gray-600 rounded-lg p-4 space-y-3">
                        <div class="flex items-start space-x-3">
                            <div class="flex-1">
                                <div class="mb-4">
                                    <label :for="'statement_text_' + index" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                        <span x-text="'Pernyataan ' + (index + 1)"></span>
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <textarea
                                        :name="'statements[' + index + '][statement_text]'"
                                        :id="'statement_text_' + index"
                                        rows="3"
                                        placeholder="Tuliskan pernyataan di sini"
                                        required
                                        x-model="statement.statement_text"
                                        class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition resize-none"
                                    ></textarea>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4 pt-8">
                                <label class="flex items-center">
                                    <input
                                        type="radio"
                                        :name="'statements[' + index + '][correct_value]'"
                                        value="1"
                                        x-model="statement.correct_value"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                                        required
                                    />
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Benar</span>
                                </label>
                                <label class="flex items-center">
                                    <input
                                        type="radio"
                                        :name="'statements[' + index + '][correct_value]'"
                                        value="0"
                                        x-model="statement.correct_value"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                                        required
                                    />
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Salah</span>
                                </label>
                                <button type="button" @click="removeStatement(index)" class="text-red-600 hover:text-red-800">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </template>

                <div x-show="statements.length === 0" class="text-center py-8 text-gray-500 dark:text-gray-400">
                    Belum ada pernyataan. Klik "Tambah Pernyataan" untuk menambah.
                </div>
            </div>
        </template>

        <x-form.form-actions :cancelUrl="route('exams.show', $exam)" />
    </form>
</x-form.form-card>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('questionForm', () => ({
        questionType: '{{ old('question_type', $question->question_type) }}',
        statements: @json(old('statements', $question->statements->map(function($statement) {
            return [
                'statement_text' => $statement->statement_text,
                'correct_value' => $statement->correct_value ? 1 : 0
            ];
        })->toArray())),
        
        init() {
            // Initialize with at least 3 empty statements if none exist and type is true_false_table
            if (this.questionType === 'true_false_table' && this.statements.length === 0) {
                this.statements = [
                    { statement_text: '', correct_value: null },
                    { statement_text: '', correct_value: null },
                    { statement_text: '', correct_value: null }
                ];
            }
        },
        
        addStatement() {
            if (this.statements.length < 5) {
                this.statements.push({ statement_text: '', correct_value: null });
            }
        },
        
        removeStatement(index) {
            if (this.statements.length > 3) {
                this.statements.splice(index, 1);
            }
        }
    }));
});
</script>
@endsection