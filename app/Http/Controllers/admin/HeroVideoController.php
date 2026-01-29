<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HeroVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = HeroVideo::ordered()->get();
        return view('admin.hero-videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hero-videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video' => 'required|file|mimes:mp4,mov,avi,wmv|max:102400', // Max 100MB
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'position' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'is_background' => 'boolean'
        ]);

        // Handle video upload
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $videoName = time() . '_' . Str::slug($request->title) . '.' . $video->getClientOriginalExtension();
            
            // Store di storage/app/public/videos/hero
            $videoPath = $video->storeAs('videos/hero', $videoName, 'public');
            
            // Path yang disimpan di database
            $validated['video_path'] = 'storage/' . $videoPath;
            
            // Debug log (opsional)
            \Log::info('Video uploaded:', [
                'original_name' => $video->getClientOriginalName(),
                'saved_name' => $videoName,
                'path' => $videoPath,
                'full_path' => 'storage/' . $videoPath,
                'public_path' => public_path('storage/' . $videoPath)
            ]);
        }

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_thumb_' . Str::slug($request->title) . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnailPath = $thumbnail->storeAs('images/hero', $thumbnailName, 'public');
            $validated['thumbnail_path'] = 'storage/' . $thumbnailPath;
        }

        $validated['is_active'] = $request->has('is_active') ? true : false;
        $validated['is_background'] = $request->has('is_background') ? true : false;

        $heroVideo = HeroVideo::create($validated);

        // Debug log
        \Log::info('HeroVideo created:', $heroVideo->toArray());

        return redirect()->route('admin.hero-videos.index')
            ->with('success', 'Video berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(HeroVideo $heroVideo)
    {
        return view('admin.hero-videos.show', compact('heroVideo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HeroVideo $heroVideo)
    {
        return view('admin.hero-videos.edit', compact('heroVideo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HeroVideo $heroVideo)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:102400',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'position' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'is_background' => 'boolean'
        ]);

        // Handle video upload
        if ($request->hasFile('video')) {
            // Delete old video
            if ($heroVideo->video_path) {
                $oldPath = str_replace('storage/', '', $heroVideo->video_path);
                Storage::disk('public')->delete($oldPath);
            }

            $video = $request->file('video');
            $videoName = time() . '_' . Str::slug($request->title) . '.' . $video->getClientOriginalExtension();
            $videoPath = $video->storeAs('videos/hero', $videoName, 'public');
            $validated['video_path'] = 'storage/' . $videoPath;
        }

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($heroVideo->thumbnail_path) {
                $oldPath = str_replace('storage/', '', $heroVideo->thumbnail_path);
                Storage::disk('public')->delete($oldPath);
            }

            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_thumb_' . Str::slug($request->title) . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnailPath = $thumbnail->storeAs('images/hero', $thumbnailName, 'public');
            $validated['thumbnail_path'] = 'storage/' . $thumbnailPath;
        }

        $validated['is_active'] = $request->has('is_active') ? true : false;
        $validated['is_background'] = $request->has('is_background') ? true : false;

        $heroVideo->update($validated);

        return redirect()->route('admin.hero-videos.index')
            ->with('success', 'Video berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HeroVideo $heroVideo)
    {
        // Delete video file
        if ($heroVideo->video_path) {
            $videoPath = str_replace('storage/', '', $heroVideo->video_path);
            Storage::disk('public')->delete($videoPath);
        }

        // Delete thumbnail file
        if ($heroVideo->thumbnail_path) {
            $thumbnailPath = str_replace('storage/', '', $heroVideo->thumbnail_path);
            Storage::disk('public')->delete($thumbnailPath);
        }

        $heroVideo->delete();

        return redirect()->route('admin.hero-videos.index')
            ->with('success', 'Video berhasil dihapus!');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(HeroVideo $heroVideo)
    {
        $heroVideo->update(['is_active' => !$heroVideo->is_active]);

        return redirect()->back()
            ->with('success', 'Status video berhasil diubah!');
    }
}
