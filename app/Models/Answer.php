<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_id',
        'question_id',
        'option_id',
        'question_statement_id',
        'answer_text',
        'is_true',
        'is_correct',
    ];

    protected function casts(): array
    {
        return [
            'is_true' => 'boolean',
            'is_correct' => 'boolean',
        ];
    }

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function option(): BelongsTo
    {
        return $this->belongsTo(Option::class);
    }

    public function questionStatement(): BelongsTo
    {
        return $this->belongsTo(QuestionStatement::class);
    }
}
