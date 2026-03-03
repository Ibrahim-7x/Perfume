<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CustomerReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Return all approved customer reviews (featured first, then newest).
     */
    public function index()
    {
        $reviews = CustomerReview::approved()
            ->featuredFirst()
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($review) {
                return [
                    'id'                => $review->id,
                    'customer_name'     => $review->customer_name,
                    'customer_title'    => $review->customer_title,
                    'avatar'            => $review->avatar,
                    'review'            => $review->review,
                    'rating'            => $review->rating,
                    'perfume_purchased' => $review->perfume_purchased,
                    'is_featured'       => $review->is_featured,
                    'created_at'        => $review->created_at->diffForHumans(),
                ];
            });

        return response()->json([
            'success' => true,
            'reviews' => $reviews,
        ]);
    }
}
