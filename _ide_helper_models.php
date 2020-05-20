<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\City
 *
 * @property int $id
 * @property string $title
 * @property string $preview_text
 * @property string $detail_text
 * @property string $img
 * @property int $country_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Country $country
 * @property-read mixed $ar_hotels
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Hotel[] $hotels
 * @property-read int|null $hotels_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tour[] $tour
 * @property-read int|null $tour_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereDetailText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City wherePreviewText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereUpdatedAt($value)
 */
	class City extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Country
 *
 * @property int $id
 * @property string $title
 * @property string $preview_text
 * @property string $detail_text
 * @property string $img
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\City[] $city
 * @property-read int|null $city_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereDetailText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country wherePreviewText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereUpdatedAt($value)
 */
	class Country extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Gallery
 *
 * @property int $id
 * @property string $name
 * @property string $img
 * @property int $tour_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Tour $tour
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gallery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gallery query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gallery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gallery whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gallery whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gallery whereTourId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gallery whereUpdatedAt($value)
 */
	class Gallery extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Hotel
 *
 * @property int $id
 * @property string $title
 * @property int $price
 * @property string $detail_text
 * @property string $img
 * @property int $city_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\City $city
 * @property-read mixed $ar_tours
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tour[] $tours
 * @property-read int|null $tours_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hotel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hotel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hotel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hotel whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hotel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hotel whereDetailText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hotel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hotel whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hotel wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hotel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hotel whereUpdatedAt($value)
 */
	class Hotel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Menu
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu query()
 */
	class Menu extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\News
 *
 * @property int $id
 * @property string $title
 * @property string $img
 * @property string $preview_text
 * @property string $detail_text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereDetailText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News wherePreviewText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereUpdatedAt($value)
 */
	class News extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Permission
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereUpdatedAt($value)
 */
	class Permission extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $perms
 * @property-read int|null $perms_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Slider
 *
 * @property int $id
 * @property string $title
 * @property string $img
 * @property int $price
 * @property int $country_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Country $country
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider whereUpdatedAt($value)
 */
	class Slider extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Tour
 *
 * @property int $id
 * @property string $title
 * @property int $price
 * @property string $detail_text
 * @property string $hot
 * @property string $img
 * @property int $type_tour_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\City $city
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Gallery[] $galleries
 * @property-read int|null $galleries_count
 * @property-read mixed $ar_hotels
 * @property-read mixed $ar_type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Hotel[] $hotels
 * @property-read int|null $hotels_count
 * @property-read \App\Type_tour $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tour newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tour newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tour query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tour whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tour whereDetailText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tour whereHot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tour whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tour whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tour wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tour whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tour whereTypeTourId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tour whereUpdatedAt($value)
 */
	class Tour extends \Eloquent {}
}

namespace App\Modules\City\Models{
/**
 * App\Modules\City\Models\City
 *
 * @property int $id
 * @property string $title
 * @property string $preview_text
 * @property string $detail_text
 * @property string $img
 * @property int $country_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Modules\Country\Models\Country $country
 * @property-read mixed $ar_hotels
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\Hotel\Models\Hotel[] $hotels
 * @property-read int|null $hotels_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\Tour\Models\Tour[] $tour
 * @property-read int|null $tour_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\City\Models\City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\City\Models\City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\City\Models\City query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\City\Models\City whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\City\Models\City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\City\Models\City whereDetailText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\City\Models\City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\City\Models\City whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\City\Models\City wherePreviewText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\City\Models\City whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\City\Models\City whereUpdatedAt($value)
 */
	class City extends \Eloquent {}
}

namespace App\Modules\Country\Models{
/**
 * App\Modules\Country\Models\Country
 *
 * @property int $id
 * @property string $title
 * @property string $preview_text
 * @property string $detail_text
 * @property string $img
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\City\Models\City[] $city
 * @property-read int|null $city_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Country\Models\Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Country\Models\Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Country\Models\Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Country\Models\Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Country\Models\Country whereDetailText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Country\Models\Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Country\Models\Country whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Country\Models\Country wherePreviewText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Country\Models\Country whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Country\Models\Country whereUpdatedAt($value)
 */
	class Country extends \Eloquent {}
}

namespace App\Modules\Hotel\Models{
/**
 * App\Modules\Hotel\Models\Hotel
 *
 * @property int $id
 * @property string $title
 * @property int $price
 * @property string $detail_text
 * @property string $img
 * @property int $city_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Modules\City\Models\City $city
 * @property-read mixed $ar_tours
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\Tour\Models\Tour[] $tours
 * @property-read int|null $tours_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Hotel\Models\Hotel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Hotel\Models\Hotel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Hotel\Models\Hotel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Hotel\Models\Hotel whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Hotel\Models\Hotel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Hotel\Models\Hotel whereDetailText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Hotel\Models\Hotel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Hotel\Models\Hotel whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Hotel\Models\Hotel wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Hotel\Models\Hotel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Hotel\Models\Hotel whereUpdatedAt($value)
 */
	class Hotel extends \Eloquent {}
}

namespace App\Modules\Navigation\Models{
/**
 * App\Modules\Navigation\Models\Navigation
 *
 * @property int $id
 * @property string $title
 * @property string $path
 * @property string $routeName
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Navigation\Models\Navigation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Navigation\Models\Navigation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Navigation\Models\Navigation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Navigation\Models\Navigation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Navigation\Models\Navigation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Navigation\Models\Navigation wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Navigation\Models\Navigation whereRouteName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Navigation\Models\Navigation whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Navigation\Models\Navigation whereUpdatedAt($value)
 */
	class Navigation extends \Eloquent {}
}

namespace App\Modules\News\Models{
/**
 * App\Modules\News\Models\News
 *
 * @property int $id
 * @property string $title
 * @property string $img
 * @property string $preview_text
 * @property string $detail_text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\News\Models\News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\News\Models\News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\News\Models\News query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\News\Models\News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\News\Models\News whereDetailText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\News\Models\News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\News\Models\News whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\News\Models\News wherePreviewText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\News\Models\News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\News\Models\News whereUpdatedAt($value)
 */
	class News extends \Eloquent {}
}

namespace App\Modules\RBAC\Models{
/**
 * Permission model.
 *
 * @package App\Modules\RBAC\Models
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\RBAC\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\RBAC\Models\Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\RBAC\Models\Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\RBAC\Models\Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\RBAC\Models\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\RBAC\Models\Permission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\RBAC\Models\Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\RBAC\Models\Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\RBAC\Models\Permission whereUpdatedAt($value)
 */
	class Permission extends \Eloquent {}
}

namespace App\Modules\RBAC\Models{
/**
 * Role model.
 *
 * @package App\Modules\RBAC\Models
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\RBAC\Models\Permission[] $perms
 * @property-read int|null $perms_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\RBAC\Models\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\RBAC\Models\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\RBAC\Models\Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\RBAC\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\RBAC\Models\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\RBAC\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\RBAC\Models\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\RBAC\Models\Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Modules\Slider\Models{
/**
 * App\Modules\Slider\Models\Slider
 *
 * @property int $id
 * @property string $title
 * @property string $img
 * @property int $price
 * @property int $country_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Modules\Country\Models\Country $country
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Slider\Models\Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Slider\Models\Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Slider\Models\Slider query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Slider\Models\Slider whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Slider\Models\Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Slider\Models\Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Slider\Models\Slider whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Slider\Models\Slider wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Slider\Models\Slider whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Slider\Models\Slider whereUpdatedAt($value)
 */
	class Slider extends \Eloquent {}
}

namespace App\Modules\Tour\Models{
/**
 * App\Modules\Tour\Models\Gallery
 *
 * @property int $id
 * @property string $name
 * @property string $img
 * @property int $tour_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Modules\Tour\Models\Tour $tour
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Gallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Gallery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Gallery query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Gallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Gallery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Gallery whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Gallery whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Gallery whereTourId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Gallery whereUpdatedAt($value)
 */
	class Gallery extends \Eloquent {}
}

namespace App\Modules\Tour\Models{
/**
 * App\Modules\Tour\Models\Tour
 *
 * @property int $id
 * @property string $title
 * @property int $price
 * @property string $detail_text
 * @property string $hot
 * @property string $img
 * @property int $type_tour_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Modules\City\Models\City $city
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\Tour\Models\Gallery[] $galleries
 * @property-read int|null $galleries_count
 * @property-read mixed $ar_hotels
 * @property-read mixed $ar_type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\Hotel\Models\Hotel[] $hotels
 * @property-read int|null $hotels_count
 * @property-read \App\Modules\Tour\Models\Type $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Tour newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Tour newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Tour query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Tour whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Tour whereDetailText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Tour whereHot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Tour whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Tour whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Tour wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Tour whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Tour whereTypeTourId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Tour whereUpdatedAt($value)
 */
	class Tour extends \Eloquent {}
}

namespace App\Modules\Tour\Models{
/**
 * App\Modules\Tour\Models\Type
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Type newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Type newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Type query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Type whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Type whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Type whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tour\Models\Type whereUpdatedAt($value)
 */
	class Type extends \Eloquent {}
}

namespace App\Modules\User\Models{
/**
 * App\Modules\User\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $login
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\User\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\User\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\User\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\User\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\User\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\User\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\User\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\User\Models\User whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\User\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\User\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\User\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\User\Models\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\Type_tour
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type_tour newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type_tour newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type_tour query()
 */
	class Type_tour extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $login
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

