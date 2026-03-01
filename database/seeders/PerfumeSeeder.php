<?php

namespace Database\Seeders;

use App\Models\Perfume;
use App\Models\PerfumeImage;
use App\Models\PerfumeNote;
use Illuminate\Database\Seeder;

class PerfumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perfumes = [
            [
                'name' => 'Royal Oud',
                'description' => 'Deep oud, sandalwood and amber with a citrus opening. Perfect for confident and sophisticated occasions.',
                'price' => 4949,
                'original_price' => 5999,
                'stock_quantity' => 50,
                'rating' => 4.8,
                'rating_count' => 124,
                'city' => 'Lahore',
                'recommended_temperature' => 'Below 21°C',
                'longevity_hours' => 10,
                'is_featured' => true,
                'is_bestseller' => true,
                'notes' => ['Oud', 'Sandalwood', 'Amber', 'Citrus'],
            ],
            [
                'name' => 'Midnight Elixir',
                'description' => 'A mysterious blend of dark vanilla, patchouli, and exotic spices. Ideal for evening wear.',
                'price' => 4499,
                'original_price' => 5499,
                'stock_quantity' => 35,
                'rating' => 4.6,
                'rating_count' => 89,
                'city' => 'Karachi',
                'recommended_temperature' => '20-30°C',
                'longevity_hours' => 8,
                'is_featured' => true,
                'is_bestseller' => true,
                'notes' => ['Vanilla', 'Patchouli', 'Spices', 'Musk'],
            ],
            [
                'name' => 'Dubai Gold',
                'description' => 'Luxurious blend of rare oud, rose, and precious amber. The signature scent of elegance.',
                'price' => 6999,
                'original_price' => 7999,
                'stock_quantity' => 25,
                'rating' => 4.9,
                'rating_count' => 156,
                'city' => 'Dubai',
                'recommended_temperature' => 'Above 30°C',
                'longevity_hours' => 12,
                'is_featured' => true,
                'is_bestseller' => true,
                'notes' => ['Oud', 'Rose', 'Amber', 'Bergamot'],
            ],
            [
                'name' => 'London Fog',
                'description' => 'Fresh and sophisticated fragrance with bergamot, lavender, and sandalwood.',
                'price' => 3999,
                'original_price' => 4999,
                'stock_quantity' => 45,
                'rating' => 4.5,
                'rating_count' => 67,
                'city' => 'London',
                'recommended_temperature' => 'Below 21°C',
                'longevity_hours' => 6,
                'is_featured' => false,
                'is_bestseller' => false,
                'notes' => ['Bergamot', 'Lavender', 'Sandalwood', 'Oakmoss'],
            ],
            [
                'name' => 'Islamabad Rose',
                'description' => 'Delicate floral fragrance with fresh rose, jasmine, and white musk.',
                'price' => 2999,
                'original_price' => 3999,
                'stock_quantity' => 60,
                'rating' => 4.4,
                'rating_count' => 92,
                'city' => 'Islamabad',
                'recommended_temperature' => '20-30°C',
                'longevity_hours' => 7,
                'is_featured' => false,
                'is_bestseller' => true,
                'notes' => ['Rose', 'Jasmine', 'White Musk', 'Peony'],
            ],
            [
                'name' => 'Summer Breeze',
                'description' => 'Light and refreshing citrus blend perfect for hot summer days.',
                'price' => 2499,
                'original_price' => 2999,
                'stock_quantity' => 80,
                'rating' => 4.3,
                'rating_count' => 45,
                'city' => null,
                'recommended_temperature' => 'Above 30°C',
                'longevity_hours' => 5,
                'is_featured' => false,
                'is_bestseller' => false,
                'notes' => ['Lemon', 'Orange', 'Sea Salt', 'Green Tea'],
            ],
            [
                'name' => 'Winter Amber',
                'description' => 'Warm and cozy amber, vanilla, and cinnamon blend for cold evenings.',
                'price' => 3499,
                'original_price' => 4299,
                'stock_quantity' => 40,
                'rating' => 4.5,
                'rating_count' => 58,
                'city' => null,
                'recommended_temperature' => 'Below 21°C',
                'longevity_hours' => 9,
                'is_featured' => true,
                'is_bestseller' => false,
                'notes' => ['Amber', 'Vanilla', 'Cinnamon', 'Tonka Bean'],
            ],
            [
                'name' => 'Arabian Nights',
                'description' => 'Exotic middle eastern blend with oud, frankincense, and myrrh.',
                'price' => 5999,
                'original_price' => 6999,
                'stock_quantity' => 30,
                'rating' => 4.7,
                'rating_count' => 78,
                'city' => 'Dubai',
                'recommended_temperature' => '20-30°C',
                'longevity_hours' => 11,
                'is_featured' => true,
                'is_bestseller' => true,
                'notes' => ['Oud', 'Frankincense', 'Myrrh', 'Sandalwood'],
            ],
        ];

        foreach ($perfumes as $perfumeData) {
            $notes = $perfumeData['notes'];
            unset($perfumeData['notes']);

            $perfume = Perfume::create($perfumeData);

            // Add notes
            foreach ($notes as $note) {
                PerfumeNote::create([
                    'perfume_id' => $perfume->id,
                    'note' => $note,
                    'type' => 'middle',
                ]);
            }

            // Add a default image placeholder
            PerfumeImage::create([
                'perfume_id' => $perfume->id,
                'image_path' => 'perfumes/default.jpg',
                'is_primary' => true,
                'sort_order' => 0,
            ]);
        }
    }
}
