<?php

namespace App\Providers;

use App\Models\City;
use App\Models\Country;
use App\Models\Gallery;
use App\Models\Hotel;
use App\Models\News;
use App\Models\Slider;
use App\Models\Tour;
use App\Policies\CityPolicy;
use App\Policies\CountryPolicy;
use App\Policies\GalleryPolicy;
use App\Policies\HotelPolicy;
use App\Policies\NewsPolicy;
use App\Policies\SliderPolicy;
use App\Policies\TourPolicy;
use App\Policies\UserPolicy;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Country::class => CountryPolicy::class,
        City::class => CityPolicy::class,
        Hotel::class => HotelPolicy::class,
        Tour::class => TourPolicy::class,
        News::class => NewsPolicy::class,
        Slider::class => SliderPolicy::class,
        User::class => UserPolicy::class,
        Gallery::class => GalleryPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('VIEW_ADMIN', function (User $user) {
           return $user->canDo('VIEW_ADMIN', false);
        });

        Gate::define('VIEW_ADMIN_TOURS', function (User $user) {
            return $user->canDo('VIEW_ADMIN_TOURS', false);
        });

        Gate::define('VIEW_ADMIN_HOTELS', function (User $user) {
            return $user->canDo('VIEW_ADMIN_HOTELS', false);
        });

        Gate::define('VIEW_ADMIN_COUNTRIES', function (User $user) {
            return $user->canDo('VIEW_ADMIN_COUNTRIES', false);
        });

        Gate::define('VIEW_ADMIN_CITIES', function (User $user) {
            return $user->canDo('VIEW_ADMIN_CITIES', false);
        });

        Gate::define('VIEW_ADMIN_NEWS', function (User $user) {
            return $user->canDo('VIEW_ADMIN_NEWS', false);
        });

        Gate::define('VIEW_ADMIN_USERS', function (User $user) {
            return $user->canDo('VIEW_ADMIN_USERS', false);
        });

        Gate::define('VIEW_ADMIN_SLIDERS', function (User $user) {
            return $user->canDo('VIEW_ADMIN_SLIDERS', false);
        });

        Gate::define('CHANGE_PERMISSIONS', function (User $user) {
            return $user->canDo('CHANGE_PERMISSIONS', false);
        });

        Gate::define('VIEW_ADMIN_GALLERIES', function (User $user) {
            return $user->canDo('VIEW_ADMIN_GALLERIES', false);
        });
        Gate::define('VIEW_ADMIN_MENUS', function (User $user) {
            return $user->canDo('VIEW_ADMIN_MENUS', false);
        });

    }
}
