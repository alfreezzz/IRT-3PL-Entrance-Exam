<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_id',
        'total_correct',
        'score_classical',
        'score_irt',
        'score_classical_weighted',
        'score_irt_weighted',
        'final_score',
        'scoring_breakdown',
    ];

    protected function casts(): array
    {
        return [
            'score_classical' => 'decimal:2',
            'score_irt' => 'decimal:5',
            'score_classical_weighted' => 'decimal:5',
            'score_irt_weighted' => 'decimal:5',
            'final_score' => 'decimal:5',
            'scoring_breakdown' => 'array',
        ];
    }

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class);
    }
}
