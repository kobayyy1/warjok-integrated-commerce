<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string $image
 * @property string|null $link
 * @property int $is_active
 * @property int $warung_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $image_url
 * @property-read \App\Models\Store|null $store
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner forStore($storeId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Banner whereWarungId($value)
 */
	class Banner extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $video_path
 * @property string|null $thumbnail_path
 * @property int $position
 * @property bool $is_active
 * @property bool $is_background
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $thumbnail_url
 * @property-read mixed $video_url
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroVideo active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroVideo background()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroVideo mainVideos()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroVideo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroVideo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroVideo ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroVideo query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroVideo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroVideo whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroVideo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroVideo whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroVideo whereIsBackground($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroVideo wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroVideo whereThumbnailPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroVideo whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroVideo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroVideo whereVideoPath($value)
 */
	class HeroVideo extends \Eloquent {}
}

namespace App\Models{
/**
 * Model Product
 *
 * @property int $id
 * @property int $store_id
 * @property string $name
 * @property string $sku
 * @property string|null $description
 * @property numeric $price
 * @property int $stock
 * @property string|null $image
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Store $store
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product forStore($storeId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int $discount_percentage
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property int $is_active
 * @property int $warung_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $formatted_value
 * @property-read \App\Models\Warung $warung
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promo active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promo forWarung($warungId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promo query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promo whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promo whereDiscountPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promo whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promo whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promo whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promo whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Promo whereWarungId($value)
 */
	class Promo extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $address
 * @property string|null $phone
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Store newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Store newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Store query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Store whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Store whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Store whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Store whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Store whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Store wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Store whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Store whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Store extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property int|null $store_id
 * @property string $role
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Store|null $store
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
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
	class Warung extends \Eloquent {}
}

