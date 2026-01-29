<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model Product
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'name',
        'sku',
        'description',
        'price',
        'stock',
        'image',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    // Scope untuk filter berdasarkan store
    public function scopeForStore($query, $storeId)
    {
        return $query->where('store_id', $storeId);
    }

    // Scope untuk produk aktif
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}