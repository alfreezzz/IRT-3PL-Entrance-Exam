<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionStatement extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'statement_text',
        'correct_value',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'correct_value' => 'boolean',
        ];
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
