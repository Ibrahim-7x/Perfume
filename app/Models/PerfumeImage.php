<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerfumeImage extends Model
{
    protected $fillable = [
        'perfume_id',
        'image_path',
        'is_primary',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_primary' => 'boolean',
        ];
    }

    /**
     * Get the perfume that owns the image.
     */
    public function perfume(): BelongsTo
    {
        return $this->belongsTo(Perfume::class);
    }
}
