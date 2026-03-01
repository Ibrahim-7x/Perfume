<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerfumeNote extends Model
{
    protected $fillable = [
        'perfume_id',
        'note',
        'type',
    ];

    /**
     * Get the perfume that owns the note.
     */
    public function perfume(): BelongsTo
    {
        return $this->belongsTo(Perfume::class);
    }
}
