<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExamSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exam_ids',
        'current_exam_id',
        'current_index',
        'status',
        'started_at',
        'current_started_at',
        'break_ends_at',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'exam_ids' => 'array',
            'started_at' => 'datetime',
            'current_started_at' => 'datetime',
            'break_ends_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function currentExam(): BelongsTo
    {
        return $this->belongsTo(Exam::class, 'current_exam_id');
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    public function isActive(): bool
    {
        return in_array($this->status, ['pending', 'running', 'break'], true);
    }
}
