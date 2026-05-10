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
        'capacity',
        'portfolio_required',
        'portfolio_description',
        'portfolio_weight',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'portfolio_required' => 'boolean',
        ];
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(Participant::class, 'program_participant')
            ->withPivot('choice_order', 'portfolio_path', 'portfolio_uploaded_at')
            ->withTimestamps();
    }

    public function programSubtestWeights(): HasMany
    {
        return $this->hasMany(ProgramSubtestWeight::class);
    }
}
