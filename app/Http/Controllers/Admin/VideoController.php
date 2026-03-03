<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TvVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Get the currently active TV video.
     */
    public function active()
    {
        $video = TvVideo::where('is_active', true)->latest()->first();

        if (!$video) {
            return response()->json(['video' => null]);
        }

        return response()->json([
            'video' => [
                'id' => $video->id,
                'title' => $video->title,
                'url' => asset('storage/tv-videos/' . $video->file_path),
                'is_active' => $video->is_active,
            ]
        ]);
    }

    /**
     * List all TV videos.
     */
    public function index()
    {
        $videos = TvVideo::latest()->get()->map(function ($video) {
            return [
                'id' => $video->id,
                'title' => $video->title,
                'url' => asset('storage/tv-videos/' . $video->file_path),
                'is_active' => $video->is_active,
                'created_at' => $video->created_at->toDateTimeString(),
            ];
        });

        return response()->json(['videos' => $videos]);
    }

    /**
     * Upload a new TV video.
     */
    public function store(Request $request)
    {
        $request->validate([
            'video' => 'required|file|mimes:mp4,webm,ogg,mov|max:102400', // 100MB max
            'title' => 'nullable|string|max:255',
        ]);

        $file = $request->file('video');

        // Validate video dimensions using getimagesize / ffprobe fallback
        $tmpPath = $file->getPathname();
        $dimensions = $this->getVideoDimensions($tmpPath);

        if ($dimensions) {
            $width = $dimensions['width'];
            $height = $dimensions['height'];

            // Minimum: 640x360 (360p)
            if ($width < 640 || $height < 360) {
                return response()->json([
                    'message' => "Video resolution too low ({$width}x{$height}). Minimum required: 640x360 (360p).",
                    'errors' => ['video' => ["Minimum resolution is 640x360. Your video is {$width}x{$height}."]]
                ], 422);
            }

            // Maximum: 3840x2160 (4K)
            if ($width > 3840 || $height > 2160) {
                return response()->json([
                    'message' => "Video resolution too high ({$width}x{$height}). Maximum allowed: 3840x2160 (4K).",
                    'errors' => ['video' => ["Maximum resolution is 3840x2160 (4K). Your video is {$width}x{$height}."]]
                ], 422);
            }

            // Recommended aspect ratio check (warn but don't block)
            $aspect = $width / $height;
            // Accept 16:9 (1.77), 4:3 (1.33), 21:9 (2.33) with tolerance
            $validAspects = [16/9, 4/3, 21/9, 1/1];
            $aspectValid = false;
            foreach ($validAspects as $va) {
                if (abs($aspect - $va) < 0.15) {
                    $aspectValid = true;
                    break;
                }
            }
            // We don't block on aspect ratio, just include info in response
        }

        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('tv-videos', $filename, 'public');

        // Deactivate all other videos
        TvVideo::where('is_active', true)->update(['is_active' => false]);

        $video = TvVideo::create([
            'title' => $request->input('title', $file->getClientOriginalName()),
            'file_path' => $filename,
            'is_active' => true,
        ]);

        return response()->json([
            'message' => 'Video uploaded successfully',
            'video' => [
                'id' => $video->id,
                'title' => $video->title,
                'url' => asset('storage/tv-videos/' . $video->file_path),
                'is_active' => $video->is_active,
            ]
        ]);
    }

    /**
     * Set a video as the active TV video.
     */
    public function setActive(TvVideo $video)
    {
        TvVideo::where('is_active', true)->update(['is_active' => false]);
        $video->update(['is_active' => true]);

        return response()->json([
            'message' => 'Video set as active',
            'video' => [
                'id' => $video->id,
                'title' => $video->title,
                'url' => asset('storage/tv-videos/' . $video->file_path),
                'is_active' => true,
            ]
        ]);
    }

    /**
     * Delete a TV video.
     */
    public function destroy(TvVideo $video)
    {
        Storage::disk('public')->delete('tv-videos/' . $video->file_path);
        $video->delete();

        return response()->json(['message' => 'Video deleted successfully']);
    }

    /**
     * Get video dimensions using ffprobe or getID3.
     */
    private function getVideoDimensions(string $path): ?array
    {
        // Try ffprobe first (most reliable)
        $ffprobe = 'ffprobe';
        $cmd = sprintf(
            '%s -v error -select_streams v:0 -show_entries stream=width,height -of csv=p=0:s=x %s 2>&1',
            escapeshellcmd($ffprobe),
            escapeshellarg($path)
        );

        $output = @shell_exec($cmd);
        if ($output && preg_match('/(\d+)x(\d+)/', trim($output), $matches)) {
            return ['width' => (int)$matches[1], 'height' => (int)$matches[2]];
        }

        // Fallback: try getimagesize (works for some video formats)
        $info = @getimagesize($path);
        if ($info && $info[0] > 0 && $info[1] > 0) {
            return ['width' => $info[0], 'height' => $info[1]];
        }

        // Could not determine dimensions — allow upload
        return null;
    }
}
