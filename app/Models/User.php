<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'store_id', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }
    
    public function hasStoreAccess($storeId): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }
        return $this->store_id == $storeId;
    }
}