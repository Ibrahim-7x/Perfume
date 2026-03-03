<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_title',
        'avatar',
        'review',
        'rating',
        'perfume_purchased',
        'is_approved',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'is_approved' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    /**
     * Scope: only approved reviews.
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    /**
     * Scope: featured reviews first.
     */
    public function scopeFeaturedFirst($query)
    {
        return $query->orderByDesc('is_featured');
    }
}
