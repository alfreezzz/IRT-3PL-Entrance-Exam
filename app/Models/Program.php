<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(Participant::class, 'program_participant')
            ->withPivot('choice_order')
            ->withTimestamps();
    }

    public function programExamWeights(): HasMany
    {
        return $this->hasMany(ProgramExamWeight::class);
    }
}
