<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warung newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warung newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warung query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warung whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warung whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warung whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warung whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warung whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Warung extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}