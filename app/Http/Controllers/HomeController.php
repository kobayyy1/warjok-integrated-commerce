<?php

namespace App\Http\Controllers;

use App\Models\HeroVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function home()
    {
        // Ambil semua video yang aktif dan urutkan berdasarkan posisi
        $heroVideos = HeroVideo::active()->ordered()->get();
        
        // Debug: Log informasi video untuk troubleshooting
        Log::info('Home page loaded with videos:', [
            'total_videos' => $heroVideos->count(),
            'videos' => $heroVideos->map(function($video) {
                return [
                    'id' => $video->id,
                    'title' => $video->title,
                    'video_path' => $video->video_path,
                    'is_background' => $video->is_background,
                    'is_active' => $video->is_active,
                    'position' => $video->position,
                    'file_exists' => $this->checkVideoExists($video->video_path),
                    'full_url' => asset($video->video_path)
                ];
            })
        ]);
        
        // PERBAIKAN: Pisahkan video background dan main videos, lalu kirim keduanya ke view
        $backgroundVideo = $heroVideos->where('is_background', true)->first();
        $mainVideos = $heroVideos->where('is_background', false);
        
        // Log untuk debugging
        if ($backgroundVideo) {
            Log::info('Background video found:', [
                'title' => $backgroundVideo->title,
                'path' => $backgroundVideo->video_path,
                'exists' => $this->checkVideoExists($backgroundVideo->video_path)
            ]);
        } else {
            Log::warning('No background video found');
        }
        
        Log::info('Main videos count: ' . $mainVideos->count());
        
        // PERBAIKAN: Kirim semua variable yang dibutuhkan ke view
        return view('home', compact('heroVideos', 'backgroundVideo', 'mainVideos'));
    }
    
    /**
     * Helper method untuk check apakah video file benar-benar ada
     */
    private function checkVideoExists($videoPath)
    {
        if (!$videoPath) {
            return false;
        }
        
        // Hapus prefix 'storage/' jika ada untuk cek di storage disk
        $cleanPath = str_replace('storage/', '', $videoPath);
        
        // Cek apakah file ada di public storage
        $existsInStorage = Storage::disk('public')->exists($cleanPath);
        
        // Cek apakah file ada di public folder (via symlink)
        $publicPath = public_path($videoPath);
        $existsInPublic = file_exists($publicPath);
        
        Log::debug('Video file check:', [
            'original_path' => $videoPath,
            'clean_path' => $cleanPath,
            'exists_in_storage' => $existsInStorage,
            'exists_in_public' => $existsInPublic,
            'public_path' => $publicPath
        ]);
        
        return $existsInStorage && $existsInPublic;
    }
}