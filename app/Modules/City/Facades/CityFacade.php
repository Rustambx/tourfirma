<?php

namespace App\Modules\City\Facades;

use Illuminate\Support\Facades\Facade;

class CityFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return 'city';
    }
}
