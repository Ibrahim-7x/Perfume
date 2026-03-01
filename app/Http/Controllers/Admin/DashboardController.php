<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perfume;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Get admin dashboard stats
    public function stats()
    {
        $perfumeCount = Perfume::where('is_active', true)->count();
        $totalPerfumes = Perfume::count();
        $featuredPerfumes = Perfume::where('is_featured', true)->count();
        $bestsellerPerfumes = Perfume::where('is_bestseller', true)->count();
        
        $totalUsers = User::count();
        $adminUsers = User::role(['admin', 'super_admin'])->count();
        
        // Calculate total value of all perfumes (for demo purposes)
        $totalInventoryValue = Perfume::sum('price');
        
        return response()->json([
            'success' => true,
            'stats' => [
                'perfumeCount' => $perfumeCount,
                'totalPerfumes' => $totalPerfumes,
                'featuredPerfumes' => $featuredPerfumes,
                'bestsellerPerfumes' => $bestsellerPerfumes,
                'totalUsers' => $totalUsers,
                'adminUsers' => $adminUsers,
                'totalInventoryValue' => number_format($totalInventoryValue, 2),
                'averageRating' => number_format(Perfume::avg('rating') ?? 0, 1),
            ]
        ]);
    }
}
