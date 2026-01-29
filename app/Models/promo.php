<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'warung_id',
        'name',
        'code',
        'description',
        'type',
        'value',
        'min_purchase',
        'max_discount',
        'usage_limit',
        'usage_count',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'min_purchase' => 'decimal:2',
        'max_discount' => 'decimal:2',
        'usage_limit' => 'integer',
        'usage_count' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Relasi ke Warung
     */
    public function warung()
    {
        return $this->belongsTo(Warung::class);
    }

    /**
     * Scope untuk promo aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                    ->where('start_date', '<=', Carbon::now())
                    ->where('end_date', '>=', Carbon::now());
    }

    /**
     * Scope untuk filter berdasarkan warung
     */
    public function scopeForWarung($query, $warungId)
    {
        return $query->where('warung_id', $warungId);
    }

    /**
     * Check apakah promo masih valid
     */
    public function isValid()
    {
        return $this->status === 'active' 
            && Carbon::now()->between($this->start_date, $this->end_date)
            && ($this->usage_limit === null || $this->usage_count < $this->usage_limit);
    }

    /**
     * Hitung diskon
     */
    public function calculateDiscount($amount)
    {
        if ($amount < $this->min_purchase) {
            return 0;
        }

        if ($this->type === 'percentage') {
            $discount = ($amount * $this->value) / 100;
            
            // Cek max discount jika ada
            if ($this->max_discount && $discount > $this->max_discount) {
                return $this->max_discount;
            }
            
            return $discount;
        }

        // Fixed discount
        return $this->value;
    }

    /**
     * Format nilai diskon
     */
    public function getFormattedValueAttribute()
    {
        if ($this->type === 'percentage') {
            return $this->value . '%';
        }
        return 'Rp ' . number_format($this->value, 0, ',', '.');
    }
}