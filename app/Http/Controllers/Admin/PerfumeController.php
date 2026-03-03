<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perfume;
use App\Models\PerfumeImage;
use App\Models\PerfumeNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PerfumeController extends Controller
{
    // API-style store for admin panel (JSON requests)
    public function apiStore(Request $request)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'recommended_temperature' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
            'is_featured' => 'boolean',
            'is_bestseller' => 'boolean',
            'is_active' => 'boolean',
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($validated['name']);
        $validated['original_price'] = $validated['price'];
        $validated['rating_count'] = 0;
        $validated['sort_order'] = Perfume::max('sort_order') + 1;

        // Create perfume
        $perfume = Perfume::create($validated);

        // Handle notes if provided
        if ($request->has('notes') && is_array($request->notes)) {
            foreach ($request->notes as $index => $note) {
                if (!empty($note)) {
                    PerfumeNote::create([
                        'perfume_id' => $perfume->id,
                        'note' => $note,
                        'type' => $index < 3 ? 'top' : ($index < 6 ? 'middle' : 'base'),
                    ]);
                }
            }
        }

        // Handle images (base64 data URLs from admin panel)
        if ($request->has('images') && is_array($request->images)) {
            $this->saveBase64Images($perfume, $request->images);
        }

        return response()->json([
            'success' => true,
            'id' => $perfume->id,
            'message' => 'Perfume created successfully'
        ]);
    }
    
    // API-style update for admin panel
    public function apiUpdate(Request $request, Perfume $perfume)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'recommended_temperature' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
            'is_featured' => 'boolean',
            'is_bestseller' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['original_price'] = $validated['price'];

        $perfume->update($validated);

        // Handle notes update
        if ($request->has('notes') && is_array($request->notes)) {
            $perfume->notes()->delete();
            foreach ($request->notes as $index => $note) {
                if (!empty($note)) {
                    PerfumeNote::create([
                        'perfume_id' => $perfume->id,
                        'note' => $note,
                        'type' => $index < 3 ? 'top' : ($index < 6 ? 'middle' : 'base'),
                    ]);
                }
            }
        }

        // Handle images (base64 data URLs from admin panel)
        if ($request->has('images') && is_array($request->images)) {
            // Check if any new base64 images were provided
            $hasNewImages = false;
            foreach ($request->images as $img) {
                if (!empty($img) && str_starts_with($img, 'data:image/')) {
                    $hasNewImages = true;
                    break;
                }
            }
            if ($hasNewImages) {
                // Delete old image files from storage
                foreach ($perfume->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage->image_path);
                }
                $perfume->images()->delete();
                $this->saveBase64Images($perfume, $request->images);
            }
        }

        return response()->json([
            'success' => true,
            'id' => $perfume->id,
            'message' => 'Perfume updated successfully'
        ]);
    }
    
    // API-style delete for admin panel
    public function apiDestroy(Perfume $perfume)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        
        // Delete image files from storage
        foreach ($perfume->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        // Delete related images and notes
        $perfume->images()->delete();
        $perfume->notes()->delete();
        $perfume->delete();

        return response()->json([
            'success' => true,
            'message' => 'Perfume deleted successfully'
        ]);
    }

    /**
     * Save base64 encoded images from the admin panel to disk and database.
     */
    private function saveBase64Images(Perfume $perfume, array $images): void
    {
        foreach ($images as $index => $imageData) {
            if (empty($imageData)) {
                continue;
            }

            // Handle base64 data URL (e.g., "data:image/png;base64,iVBOR...")
            if (str_starts_with($imageData, 'data:image/')) {
                // Extract mime type and base64 data
                if (preg_match('/^data:image\/(\w+);base64,(.+)$/', $imageData, $matches)) {
                    $extension = $matches[1] === 'jpeg' ? 'jpg' : $matches[1];
                    $decoded = base64_decode($matches[2]);

                    if ($decoded === false) {
                        continue;
                    }

                    $filename = 'perfume-images/' . $perfume->id . '_' . time() . '_' . $index . '.' . $extension;
                    Storage::disk('public')->put($filename, $decoded);

                    PerfumeImage::create([
                        'perfume_id' => $perfume->id,
                        'image_path' => $filename,
                        'is_primary' => $index === 0,
                        'sort_order' => $index,
                    ]);
                }
            }
        }
    }

    /**
     * Display a listing of the perfumes.
     */
    public function index(Request $request)
    {
        $query = Perfume::with(['images', 'notes']);

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('city') && $request->city) {
            $query->where('city', $request->city);
        }

        if ($request->has('is_featured')) {
            $query->where('is_featured', $request->boolean('is_featured'));
        }

        if ($request->has('is_bestseller')) {
            $query->where('is_bestseller', $request->boolean('is_bestseller'));
        }

        $perfumes = $query->orderBy('sort_order')->paginate(10);

        return view('admin.perfumes.index', compact('perfumes'));
    }

    /**
     * Show the form for creating a new perfume.
     */
    public function create()
    {
        return view('admin.perfumes.create');
    }

    /**
     * Store a newly created perfume in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'city' => 'nullable|string|max:255',
            'recommended_temperature' => 'nullable|string|max:255',
            'longevity_hours' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_bestseller' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'notes' => 'nullable|array',
            'notes.*' => 'string|max:255',
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($validated['name']);

        // Create perfume
        $perfume = Perfume::create($validated);

        // Handle images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('perfumes', 'public');
                
                PerfumeImage::create([
                    'perfume_id' => $perfume->id,
                    'image_path' => $path,
                    'is_primary' => $index === 0,
                    'sort_order' => $index,
                ]);
            }
        }

        // Handle notes
        if ($request->has('notes')) {
            foreach ($request->notes as $note) {
                if (!empty($note)) {
                    PerfumeNote::create([
                        'perfume_id' => $perfume->id,
                        'note' => $note,
                        'type' => 'middle',
                    ]);
                }
            }
        }

        return redirect()->route('admin.perfumes.index')
            ->with('success', 'Perfume created successfully.');
    }

    /**
     * Display the specified perfume.
     */
    public function show(Perfume $perfume)
    {
        $perfume->load(['images', 'notes']);
        return view('admin.perfumes.show', compact('perfume'));
    }

    /**
     * Show the form for editing the specified perfume.
     */
    public function edit(Perfume $perfume)
    {
        $perfume->load(['images', 'notes']);
        return view('admin.perfumes.edit', compact('perfume'));
    }

    /**
     * Update the specified perfume in storage.
     */
    public function update(Request $request, Perfume $perfume)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'city' => 'nullable|string|max:255',
            'recommended_temperature' => 'nullable|string|max:255',
            'longevity_hours' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_bestseller' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'notes' => 'nullable|array',
            'notes.*' => 'string|max:255',
        ]);

        // Update slug if name changed
        if ($perfume->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $perfume->update($validated);

        // Handle new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('perfumes', 'public');
                
                PerfumeImage::create([
                    'perfume_id' => $perfume->id,
                    'image_path' => $path,
                    'is_primary' => false,
                    'sort_order' => $perfume->images()->count() + $index,
                ]);
            }
        }

        // Update notes
        if ($request->has('notes')) {
            $perfume->notes()->delete();
            foreach ($request->notes as $note) {
                if (!empty($note)) {
                    PerfumeNote::create([
                        'perfume_id' => $perfume->id,
                        'note' => $note,
                        'type' => 'middle',
                    ]);
                }
            }
        }

        return redirect()->route('admin.perfumes.index')
            ->with('success', 'Perfume updated successfully.');
    }

    /**
     * Remove the specified perfume from storage.
     */
    public function destroy(Perfume $perfume)
    {
        // Delete associated images from storage
        foreach ($perfume->images as $image) {
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
        }

        $perfume->delete();

        return redirect()->route('admin.perfumes.index')
            ->with('success', 'Perfume deleted successfully.');
    }

    /**
     * Toggle featured status.
     */
    public function toggleFeatured(Perfume $perfume)
    {
        $perfume->update(['is_featured' => !$perfume->is_featured]);
        
        return response()->json([
            'success' => true,
            'is_featured' => $perfume->is_featured
        ]);
    }

    /**
     * Toggle bestseller status.
     */
    public function toggleBestseller(Perfume $perfume)
    {
        $perfume->update(['is_bestseller' => !$perfume->is_bestseller]);
        
        return response()->json([
            'success' => true,
            'is_bestseller' => $perfume->is_bestseller
        ]);
    }

    /**
     * Toggle active status.
     */
    public function toggleActive(Perfume $perfume)
    {
        $perfume->update(['is_active' => !$perfume->is_active]);
        
        return response()->json([
            'success' => true,
            'is_active' => $perfume->is_active
        ]);
    }

    /**
     * Delete an image.
     */
    public function deleteImage(PerfumeImage $image)
    {
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        $image->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Set primary image.
     */
    public function setPrimaryImage(PerfumeImage $image)
    {
        // Remove primary from all other images of this perfume
        $image->perfume->images()->update(['is_primary' => false]);
        
        // Set this image as primary
        $image->update(['is_primary' => true]);

        return response()->json(['success' => true]);
    }
}
