@extends('layouts.app')

@section('title', 'Soal ' . ($currentIndex + 1) . ' - ' . $exam->title)

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        @if(session('error'))
            <div class="rounded-3xl border border-red-200 bg-red-50 p-5 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <div class="rounded-3xl bg-white dark:bg-slate-900 p-8 shadow-sm border border-slate-200/70 dark:border-slate-800" x-data="questionSession({{ $secondsRemaining }}, {{ $isAnswered ? 'true' : 'false' }})" x-init="init()">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">{{ $exam->title }}</p>
                    <h1 class="mt-2 text-2xl font-semibold text-slate-900 dark:text-slate-100">Soal {{ $currentIndex + 1 }} dari {{ $totalQuestions }}</h1>
                    <p class="mt-3 text-slate-600 dark:text-slate-300">Jawab soal ini dengan tenang. Mohon tetap berada di halaman ini dan gunakan mode full screen.</p>
                </div>
                <div class="rounded-3xl bg-slate-50 dark:bg-slate-800 p-5 text-slate-900 dark:text-slate-100">
                    <p class="text-sm text-slate-500 dark:text-slate-400">Waktu tersisa</p>
                    <p class="mt-2 text-3xl font-semibold text-blue-600" x-text="formattedTime"></p>
                </div>
            </div>

            <!-- Question Navigation -->
            <div class="mt-6 flex flex-wrap gap-2">
                @foreach($exam->questions->sortBy('id') as $index => $q)
                    @php
                        $isCurrent = $q->id === $question->id;
                        $isAnswered = $participant->answers()->where('question_id', $q->id)->exists();
                    @endphp
                    <a href="{{ route('user.exams.session.question', [$session, $q]) }}"
                       class="w-10 h-10 rounded-lg border-2 flex items-center justify-center text-sm font-medium transition-colors
                              {{ $isCurrent ? 'border-blue-600 bg-blue-600 text-white' :
                                 ($isAnswered ? 'border-green-600 bg-green-600 text-white' : 'border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:border-slate-400 dark:hover:border-slate-500') }}">
                        {{ $index + 1 }}
                    </a>
                @endforeach
            </div>

            <div class="mt-8 space-y-6">
                <!-- Question Content -->
                <div class="rounded-3xl border border-slate-200/70 dark:border-slate-800 p-6 bg-white dark:bg-slate-950">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-700 dark:text-slate-100 mb-3">Soal {{ $currentIndex + 1 }}</p>
                            <div class="ql-content text-slate-600 dark:text-slate-300 mb-5">{!! $question->question_text !!}</div>
                        </div>
                    </div>

                    <form x-data="answerForm()" @submit.prevent="saveAnswer" class="space-y-4">
                        @if($question->question_type === 'single_choice')
                            @foreach($question->options as $option)
                                <label class="flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200/70 dark:border-slate-700 bg-white dark:bg-slate-900 p-4 transition hover:border-blue-300">
                                    <input type="radio" name="answer" value="{{ $option->id }}" class="h-4 w-4 text-blue-600" x-model="selectedAnswer" />
                                    <span class="ql-content text-slate-700 dark:text-slate-200">{!! $option->option_text !!}</span>
                                </label>
                            @endforeach
                        @elseif($question->question_type === 'multiple_choice')
                            @foreach($question->options as $option)
                                <label class="flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200/70 dark:border-slate-700 bg-white dark:bg-slate-900 p-4 transition hover:border-blue-300">
                                    <input type="checkbox" name="answer[]" value="{{ $option->id }}" class="h-4 w-4 text-blue-600" x-model="selectedAnswers" />
                                    <span class="ql-content text-slate-700 dark:text-slate-200">{!! $option->option_text !!}</span>
                                </label>
                            @endforeach
                    @elseif($question->question_type === 'true_false_table')
                        @php
                            $existingTableAnswers = [];
                            foreach($participant->answers()->where('question_id', $question->id)->get() as $answer) {
                                // For true_false_table, we store answers per statement
                                // Assuming answer_text contains 'true' or 'false'
                                $statementId = null;
                                foreach($question->statements as $stmt) {
                                    if(strpos($answer->answer_text, $stmt->statement_text) !== false || $answer->option_id == $stmt->id) {
                                        $statementId = $stmt->id;
                                        break;
                                    }
                                }
                                if($statementId) {
                                    $existingTableAnswers[$statementId] = $answer->is_true ? '1' : '0';
                                }
                            }
                        @endphp
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse border border-slate-200/70 dark:border-slate-700">
                                <thead>
                                    <tr class="bg-slate-50 dark:bg-slate-800">
                                        <th class="border border-slate-200/70 dark:border-slate-700 p-3 text-left text-sm font-medium text-slate-700 dark:text-slate-200">Statement</th>
                                        <th class="border border-slate-200/70 dark:border-slate-700 p-3 text-center text-sm font-medium text-slate-700 dark:text-slate-200">True</th>
                                        <th class="border border-slate-200/70 dark:border-slate-700 p-3 text-center text-sm font-medium text-slate-700 dark:text-slate-200">False</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($question->statements->sortBy('order') as $statement)
                                        <tr class="bg-white dark:bg-slate-950">
                                            <td class="border border-slate-200/70 dark:border-slate-700 p-3 text-slate-700 dark:text-slate-200">
                                                <div class="ql-content">{!! $statement->statement_text !!}</div>
                                            </td>
                                            <td class="border border-slate-200/70 dark:border-slate-700 p-3 text-center">
                                                <input type="radio" name="answer[{{ $statement->id }}]" value="1" class="h-4 w-4 text-blue-600" x-model="tableAnswers['{{ $statement->id }}']" />
                                            </td>
                                            <td class="border border-slate-200/70 dark:border-slate-700 p-3 text-center">
                                                <input type="radio" name="answer[{{ $statement->id }}]" value="0" class="h-4 w-4 text-blue-600" x-model="tableAnswers['{{ $statement->id }}']" />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <input type="text" name="answer" x-model="textAnswer" class="w-full rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-3 text-slate-900 dark:text-slate-100 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20" placeholder="Tulis jawaban Anda di sini...">
                        @endif

                        <div class="flex items-center justify-between pt-4 border-t border-slate-200/70 dark:border-slate-700">
                            <div class="flex gap-3">
                                @if($prevQuestion)
                                    <a href="{{ route('user.exams.session.question', [$session, $prevQuestion]) }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-200 transition hover:bg-slate-50 dark:hover:bg-slate-700">
                                        ← Sebelumnya
                                    </a>
                                @endif
                                @if($nextQuestion)
                                    <a href="{{ route('user.exams.session.question', [$session, $nextQuestion]) }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-200 transition hover:bg-slate-50 dark:hover:bg-slate-700">
                                        Selanjutnya →
                                    </a>
                                @endif
                            </div>

                            <div class="flex gap-3">
                                <button type="submit" :disabled="isSaving" class="inline-flex items-center justify-center rounded-2xl bg-green-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-green-700 disabled:opacity-50">
                                    <span x-show="!isSaving">Simpan Jawaban</span>
                                    <span x-show="isSaving" x-text="savingText"></span>
                                </button>

                                @if($nextQuestion)
                                    <button type="button" @click="saveAndNext" :disabled="isSaving" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-700 disabled:opacity-50">
                                        Simpan & Lanjutkan
                                    </button>
                                @else
                                    <form method="POST" action="{{ route('user.exams.session.submit', $session) }}">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-700">
                                            Selesai Ujian
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function questionSession(initialSeconds, answered) {
            return {
                seconds: initialSeconds,
                isFullscreen: false,
                statusMessage: 'Tetap di halaman ini. Jangan berpindah tab.',
                currentIndex: {{ $currentIndex }},
                totalQuestions: {{ $totalQuestions }},

                init() {
                    this.startTimer();
                    document.addEventListener('visibilitychange', () => {
                        if (document.hidden) {
                            this.statusMessage = 'Tab berganti. Kembali ke ujian sekarang.';
                        } else {
                            this.statusMessage = 'Tetap di halaman ini. Jangan berpindah tab.';
                        }
                    });
                },

                startTimer() {
                    setInterval(() => {
                        if (this.seconds > 0) {
                            this.seconds -= 1;
                        }
                    }, 1000);
                },

                enterFullscreen() {
                    const element = document.documentElement;
                    if (element.requestFullscreen) {
                        element.requestFullscreen();
                    } else if (element.webkitRequestFullscreen) {
                        element.webkitRequestFullscreen();
                    } else if (element.mozRequestFullScreen) {
                        element.mozRequestFullScreen();
                    } else if (element.msRequestFullscreen) {
                        element.msRequestFullscreen();
                    }
                    this.isFullscreen = true;
                    this.statusMessage = 'Mode full screen aktif. Jangan berpindah tab.';
                },

                get formattedTime() {
                    const minutes = Math.floor(this.seconds / 60).toString().padStart(2, '0');
                    const seconds = (this.seconds % 60).toString().padStart(2, '0');
                    return `${minutes}:${seconds}`;
                }
            };
        }

        function answerForm() {
            return {
                selectedAnswer: '',
                selectedAnswers: [],
                tableAnswers: {},
                textAnswer: '',
                isSaving: false,
                savingText: 'Menyimpan...',

                init() {
                    // Load existing answers if any
                    @if($question->question_type === 'single_choice')
                        @php
                            $existingAnswer = $participant->answers()->where('question_id', $question->id)->first();
                        @endphp
                        @if($existingAnswer)
                            this.selectedAnswer = '{{ $existingAnswer->option_id }}';
                        @endif
                    @elseif($question->question_type === 'multiple_choice')
                        @php
                            $existingAnswers = $participant->answers()->where('question_id', $question->id)->pluck('option_id')->toArray();
                        @endphp
                        this.selectedAnswers = {{ json_encode($existingAnswers) }};
                    @elseif($question->question_type === 'true_false_table')
                        @php
                            $existingTableAnswers = [];
                            foreach($participant->answers()->where('question_id', $question->id)->get() as $answer) {
                                $statementId = $answer->option_id; // statement_id stored in option_id
                                if ($statementId) {
                                    $existingTableAnswers[$statementId] = $answer->is_true ? '1' : '0';
                                }
                            }
                        @endphp
                        this.tableAnswers = {{ json_encode($existingTableAnswers) }};
                    @else
                        @php
                            $existingAnswer = $participant->answers()->where('question_id', $question->id)->first();
                        @endphp
                        @if($existingAnswer)
                            this.textAnswer = '{{ $existingAnswer->answer_text }}';
                        @endif
                    @endif
                },

                async saveAnswer() {
                    this.isSaving = true;
                    this.savingText = 'Menyimpan...';

                    try {
                        let answerData = null;

                        if ('{{ $question->question_type }}' === 'single_choice') {
                            answerData = this.selectedAnswer;
                        } else if ('{{ $question->question_type }}' === 'multiple_choice') {
                            answerData = this.selectedAnswers;
                        } else if ('{{ $question->question_type }}' === 'true_false_table') {
                            answerData = this.tableAnswers;
                        } else {
                            answerData = this.textAnswer;
                        }

                        const response = await fetch('{{ route('user.exams.session.save-answer', [$session, $question]) }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ answer: answerData })
                        });

                        if (response.ok) {
                            this.savingText = 'Tersimpan ✓';
                            setTimeout(() => {
                                this.savingText = 'Menyimpan...';
                            }, 2000);
                        } else {
                            throw new Error('Failed to save');
                        }
                    } catch (error) {
                        this.savingText = 'Gagal menyimpan ✗';
                        setTimeout(() => {
                            this.savingText = 'Menyimpan...';
                        }, 2000);
                    } finally {
                        this.isSaving = false;
                    }
                },

                async saveAndNext() {
                    await this.saveAnswer();
                    setTimeout(() => {
                        window.location.href = '{{ $nextQuestion ? route('user.exams.session.question', [$session, $nextQuestion]) : '#' }}';
                    }, 500);
                }
            };
        }
    </script>
@endsection