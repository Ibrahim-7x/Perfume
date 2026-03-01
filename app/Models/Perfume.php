<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Perfume extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'original_price',
        'stock_quantity',
        'rating',
        'rating_count',
        'city',
        'recommended_temperature',
        'longevity_hours',
        'is_featured',
        'is_bestseller',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'original_price' => 'decimal:2',
            'rating' => 'decimal:1',
            'is_featured' => 'boolean',
            'is_bestseller' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the images for the perfume.
     */
    public function images(): HasMany
    {
        return $this->hasMany(PerfumeImage::class)->orderBy('sort_order');
    }

    /**
     * Get the notes for the perfume.
     */
    public function notes(): HasMany
    {
        return $this->hasMany(PerfumeNote::class);
    }

    /**
     * Get the primary image for the perfume.
     */
    public function primaryImage()
    {
        return $this->hasOne(PerfumeImage::class)->where('is_primary', true);
    }

    /**
     * Scope a query to only include active perfumes.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include featured perfumes.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to only include bestsellers.
     */
    public function scopeBestseller($query)
    {
        return $query->where('is_bestseller', true);
    }

    /**
     * Get the formatted price.
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rs ' . number_format($this->price, 0);
    }

    /**
     * Get all image paths as array.
     */
    public function getImagesArrayAttribute(): array
    {
        return $this->images->pluck('image_path')->toArray();
    }

    /**
     * Get notes as array.
     */
    public function getNotesArrayAttribute(): array
    {
        return $this->notes->pluck('note')->toArray();
    }
}
