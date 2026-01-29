<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'title',
        'description',
        'image',
        'link',
        'order',
        'status',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    /**
     * Relasi ke Store
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Scope untuk banner aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope untuk filter berdasarkan store
     */
    public function scopeForStore($query, $storeId)
    {
        return $query->where('store_id', $storeId);
    }

    /**
     * Scope untuk urutan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    /**
     * Accessor untuk URL gambar
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/no-banner.png');
    }
}