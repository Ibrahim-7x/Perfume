<?php

namespace Database\Seeders;

use App\Models\CustomerReview;
use Illuminate\Database\Seeder;

class CustomerReviewSeeder extends Seeder
{
    /**
     * Seed the customer_reviews table with sample data.
     */
    public function run(): void
    {
        $reviews = [
            [
                'customer_name'     => 'Sarah Al-Rashid',
                'customer_title'    => 'Fashion Blogger, Dubai',
                'avatar'            => null,
                'review'            => 'Absolutely mesmerizing! The Midnight Elixir has become my signature scent. Every time I wear it, I receive countless compliments. The longevity is incredible — it lasts well into the evening.',
                'rating'            => 5,
                'perfume_purchased' => 'Midnight Elixir',
                'is_approved'       => true,
                'is_featured'       => true,
            ],
            [
                'customer_name'     => 'Mark Chen',
                'customer_title'    => 'CTO, TechNova Solutions',
                'avatar'            => null,
                'review'            => 'The Royal Oud is the perfect power fragrance. I wear it to every board meeting and it exudes confidence. TROY Perfumes truly understands luxury.',
                'rating'            => 5,
                'perfume_purchased' => 'Royal Oud',
                'is_approved'       => true,
                'is_featured'       => true,
            ],
            [
                'customer_name'     => 'Amina Yousaf',
                'customer_title'    => 'Interior Designer',
                'avatar'            => null,
                'review'            => 'I bought the Velvet Rose for my anniversary and my husband loved it. The packaging alone is a work of art. Will definitely be purchasing more from TROY.',
                'rating'            => 5,
                'perfume_purchased' => 'Velvet Rose',
                'is_approved'       => true,
                'is_featured'       => false,
            ],
            [
                'customer_name'     => 'James O\'Brien',
                'customer_title'    => 'Entrepreneur',
                'avatar'            => null,
                'review'            => 'Fresh and invigorating — the Citrus Burst is my everyday go-to. Light enough for the office but still noticeable. Great value for the quality.',
                'rating'            => 4,
                'perfume_purchased' => 'Citrus Burst',
                'is_approved'       => true,
                'is_featured'       => false,
            ],
            [
                'customer_name'     => 'Fatima Zahra',
                'customer_title'    => 'University Professor',
                'avatar'            => null,
                'review'            => 'The Amber Nights perfume transported me. It has such depth and warmth — perfect for winter evenings. The sillage is just right, not overpowering.',
                'rating'            => 5,
                'perfume_purchased' => 'Amber Nights',
                'is_approved'       => true,
                'is_featured'       => false,
            ],
            [
                'customer_name'     => 'David Kim',
                'customer_title'    => 'Marketing Director',
                'avatar'            => null,
                'review'            => 'I have tried many niche fragrances, but TROY stands out. The attention to detail, the quality of ingredients, and the customer service are all exceptional. Highly recommend!',
                'rating'            => 5,
                'perfume_purchased' => 'Noir Intense',
                'is_approved'       => true,
                'is_featured'       => false,
            ],
            [
                'customer_name'     => 'Aisha Malik',
                'customer_title'    => 'Dentist',
                'avatar'            => null,
                'review'            => 'Gifted the Ocean Breeze to my sister and she absolutely adores it. Clean, fresh, and sophisticated. TROY never disappoints.',
                'rating'            => 4,
                'perfume_purchased' => 'Ocean Breeze',
                'is_approved'       => true,
                'is_featured'       => false,
            ],
            [
                'customer_name'     => 'Ricardo Fernandez',
                'customer_title'    => 'Architect',
                'avatar'            => null,
                'review'            => 'The Smoky Leather is bold and masculine. It projects well and has an addictive dry-down. My new favorite evening fragrance without a doubt.',
                'rating'            => 5,
                'perfume_purchased' => 'Smoky Leather',
                'is_approved'       => true,
                'is_featured'       => false,
            ],
        ];

        foreach ($reviews as $review) {
            CustomerReview::create($review);
        }
    }
}
