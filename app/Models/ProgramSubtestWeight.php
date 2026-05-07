<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramSubtestWeight extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'subtest_id',
        'weight',
    ];

    protected function casts(): array
    {
        return [
            'weight' => 'decimal:2',
        ];
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function subtest(): BelongsTo
    {
        return $this->belongsTo(Subtest::class);
    }
}
