<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'video_path',
        'thumbnail_path',
        'position',
        'is_active',
        'is_background'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_background' => 'boolean',
    ];

    /**
     * Scope untuk mendapatkan video aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk mendapatkan video background
     */
    public function scopeBackground($query)
    {
        return $query->where('is_background', true);
    }

    /**
     * Scope untuk mendapatkan video utama (bukan background)
     */
    public function scopeMainVideos($query)
    {
        return $query->where('is_background', false);
    }

    /**
     * Scope untuk ordering berdasarkan position
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('position', 'asc');
    }

    /**
     * Get full video URL
     * Path di database: storage/videos/hero/filename.mp4
     * Output: http://yoursite.com/storage/videos/hero/filename.mp4
     */
    public function getVideoUrlAttribute()
    {
        if (!$this->video_path) {
            return null;
        }
        
        return asset($this->video_path);
    }

    /**
     * Get full thumbnail URL
     */
    public function getThumbnailUrlAttribute()
    {
        if (!$this->thumbnail_path) {
            return null;
        }
        
        return asset($this->thumbnail_path);
    }
}