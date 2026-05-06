<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemParameter extends Model
{
    protected function casts(): array
    {
        return [
            'a' => 'decimal:4',
            'b' => 'decimal:4',
            'c' => 'decimal:4',
        ];
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
