<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Repositories\CitiesRepository;
use App\Repositories\MenusRepository;
use Illuminate\Http\Request;
use DB;

class AjaxCityController extends SiteController
{
    protected $city_rep;
    public function __construct(MenusRepository $navigation)
    {
        parent::__construct($navigation);
        $this->city_rep = app(CitiesRepository::class);
    }

    public function getCities (Request $request)
    {
        if ($_POST['country_id'] > 0) {
            $countryId = intval($_POST['country_id']);
            $data = DB::table('cities')->where('country_id', $countryId)->get();
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }
}
