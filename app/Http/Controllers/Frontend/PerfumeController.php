<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Perfume;
use Illuminate\Http\Request;

class PerfumeController extends Controller
{
    /**
     * Display all perfumes for customer view.
     */
    public function index(Request $request)
    {
        $includeInactive = $request->get('include_inactive', false);
        
        $query = Perfume::with(['images', 'notes']);
        
        if (!$includeInactive) {
            $query->where('is_active', true);
        }

        // Filter by city
        if ($request->has('city') && $request->city) {
            $query->where('city', $request->city);
        }

        // Filter by temperature
        if ($request->has('temperature') && $request->temperature) {
            $query->where('recommended_temperature', 'like', '%' . $request->temperature . '%');
        }

        // Filter by price range
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Sort
        switch ($request->get('sort', 'default')) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('sort_order');
        }

        $perfumes = $query->get();

        return response()->json([
            'success' => true,
            'perfumes' => $perfumes->map(function ($perfume) {
                return [
                    'id' => $perfume->id,
                    'name' => $perfume->name,
                    'slug' => $perfume->slug,
                    'description' => $perfume->description,
                    'price' => (int) $perfume->price,
                    'original_price' => $perfume->original_price ? (int) $perfume->original_price : null,
                    'rating' => (float) $perfume->rating,
                    'rating_count' => (int) $perfume->rating_count,
                    'city' => $perfume->city,
                    'recommended_temperature' => $perfume->recommended_temperature,
                    'longevity_hours' => $perfume->longevity_hours,
                    'is_featured' => (bool) $perfume->is_featured,
                    'is_bestseller' => (bool) $perfume->is_bestseller,
                    'is_active' => (bool) $perfume->is_active,
                    'stock_quantity' => (int) $perfume->stock_quantity,
                    'images' => count($perfume->images) > 0 
                        ? $perfume->images->map(function($img) {
                            return 'storage/' . $img->image_path;
                        })->toArray() 
                        : ['https://images.pexels.com/photos/965981/pexels-photo-965981.jpeg?auto=compress&cs=tinysrgb&w=800'],
                    'notes' => $perfume->notes->pluck('note')->toArray(),
                ];
            })
        ]);
    }

    /**
     * Display featured perfumes.
     */
    public function featured()
    {
        $perfumes = Perfume::with(['images', 'notes'])
            ->active()
            ->featured()
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'success' => true,
            'perfumes' => $perfumes->map(function ($perfume) {
                return [
                    'id' => $perfume->id,
                    'name' => $perfume->name,
                    'price' => $perfume->price,
                    'rating' => $perfume->rating,
                    'city' => $perfume->city,
                    'recommended_temperature' => $perfume->recommended_temperature,
                    'images' => count($perfume->images) > 0
                        ? $perfume->images->map(fn($img) => 'storage/' . $img->image_path)->toArray()
                        : ['https://images.pexels.com/photos/965981/pexels-photo-965981.jpeg?auto=compress&cs=tinysrgb&w=800'],
                    'notes' => $perfume->notes->pluck('note'),
                ];
            })
        ]);
    }

    /**
     * Display bestseller perfumes.
     */
    public function bestsellers()
    {
        $perfumes = Perfume::with(['images', 'notes'])
            ->active()
            ->bestseller()
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'success' => true,
            'perfumes' => $perfumes->map(function ($perfume) {
                return [
                    'id' => $perfume->id,
                    'name' => $perfume->name,
                    'price' => $perfume->price,
                    'rating' => $perfume->rating,
                    'city' => $perfume->city,
                    'recommended_temperature' => $perfume->recommended_temperature,
                    'images' => count($perfume->images) > 0
                        ? $perfume->images->map(fn($img) => 'storage/' . $img->image_path)->toArray()
                        : ['https://images.pexels.com/photos/965981/pexels-photo-965981.jpeg?auto=compress&cs=tinysrgb&w=800'],
                    'notes' => $perfume->notes->pluck('note'),
                ];
            })
        ]);
    }

    /**
     * Display a single perfume.
     */
    public function show($id)
    {
        $perfume = Perfume::with(['images', 'notes'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'perfume' => [
                'id' => $perfume->id,
                'name' => $perfume->name,
                'slug' => $perfume->slug,
                'description' => $perfume->description,
                'price' => $perfume->price,
                'original_price' => $perfume->original_price,
                'stock_quantity' => $perfume->stock_quantity,
                'rating' => $perfume->rating,
                'rating_count' => $perfume->rating_count,
                'city' => $perfume->city,
                'recommended_temperature' => $perfume->recommended_temperature,
                'longevity_hours' => $perfume->longevity_hours,
                'is_featured' => $perfume->is_featured,
                'is_bestseller' => $perfume->is_bestseller,
                'images' => count($perfume->images) > 0
                    ? $perfume->images->map(fn($img) => 'storage/' . $img->image_path)->toArray()
                    : ['https://images.pexels.com/photos/965981/pexels-photo-965981.jpeg?auto=compress&cs=tinysrgb&w=800'],
                'notes' => $perfume->notes->pluck('note'),
            ]
        ]);
    }

    /**
     * Get perfumes by temperature for weather-based recommendations.
     */
    public function byTemperature(Request $request)
    {
        $temperature = $request->get('temperature');
        
        $perfumes = Perfume::with(['images', 'notes'])
            ->active()
            ->get()
            ->filter(function ($perfume) use ($temperature) {
                if (!$perfume->recommended_temperature) {
                    return false;
                }
                
                // Parse temperature range
                $tempRange = $perfume->recommended_temperature;
                
                if (str_contains($tempRange, 'Below')) {
                    $maxTemp = (int) filter_var($tempRange, FILTER_SANITIZE_NUMBER_INT);
                    return $temperature < $maxTemp;
                } elseif (str_contains($tempRange, 'Above')) {
                    $minTemp = (int) filter_var($tempRange, FILTER_SANITIZE_NUMBER_INT);
                    return $temperature > $minTemp;
                } elseif (str_contains($tempRange, '-')) {
                    preg_match('/(\d+)-(\d+)/', $tempRange, $matches);
                    if ($matches) {
                        return $temperature >= $matches[1] && $temperature <= $matches[2];
                    }
                }
                
                return false;
            });

        return response()->json([
            'success' => true,
            'perfumes' => $perfumes->map(function ($perfume) {
                return [
                    'id' => $perfume->id,
                    'name' => $perfume->name,
                    'price' => $perfume->price,
                    'rating' => $perfume->rating,
                    'recommended_temperature' => $perfume->recommended_temperature,
                    'images' => count($perfume->images) > 0
                        ? $perfume->images->map(fn($img) => 'storage/' . $img->image_path)->toArray()
                        : ['https://images.pexels.com/photos/965981/pexels-photo-965981.jpeg?auto=compress&cs=tinysrgb&w=800'],
                    'notes' => $perfume->notes->pluck('note'),
                ];
            })
        ]);
    }
}
