<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'question_text',
        'question_type',
        'answer_key',
    ];

    protected function casts(): array
    {
        return [
            'question_type' => 'string',
        ];
    }

    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }

    public function statements(): HasMany
    {
        return $this->hasMany(QuestionStatement::class);
    }

    public function itemParameter(): HasOne
    {
        return $this->hasOne(ItemParameter::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
