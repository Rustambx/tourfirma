<?php

namespace App\Http\Controllers;

use App\Lib\File\CImage;
use App\Models\City;
use App\Models\Country;
use App\Models\Tour;
use App\Repositories\MenusRepository;
use App\Repositories\ToursRepository;
use App\Type_tour;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Collection;

class ToursController extends SiteController
{
    protected $tour_rep;

    public function __construct(MenusRepository $navigation)
    {
        parent::__construct($navigation);
        $this->template = 'tours';
        $this->tour_rep = app(ToursRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $countries = Country::all();
        $typeTours = Type_tour::all();
        $countryId = $request->query("country");
        $cityId = $request->query("city");

        $query = Tour::query();

        if ($countryId > 0 && $cityId <= 0) {
            $arCities = City::all()->where("country_id", $countryId);
            $cities = $arCities->pluck('id');
            $query->whereHas('hotels', function ($hotelQuery) use ($cities) {
                return $hotelQuery->whereIn('city_id', $cities);
            });
        } else if ($cityId > 0) {
            $query->whereHas('hotels', function ($hotelQuery) use ($cityId) {
                return $hotelQuery->where('city_id', $cityId);
            });
        }

        if ($request->query('hot') == "Y") {
            $query->where('hot', 'Y');
        }
        if ($request->query('price') >= 100) {
            $query->where('price', '<', intval($request->query('price')));
        }
        if ($request->query('type_tour_id')){
            $query->where('type_tour_id', $request->query('type_tour_id'));
        }

        $tours = $query->get();
        foreach ($tours as $tour){
            if ($tour->img) {
                $tour->resized_image = CImage::resize($tour->img, 300, 364);
            }
        }
        $content = view('tours_content')->with(compact('tours', 'countries', 'typeTours'));
        $this->vars = Arr::add($this->vars, 'content', $content);

        return $this->renderOutput();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tour = $this->tour_rep->one($id);
        $arResult = [
            "countries" => [],
            "cities" => [],
            "hotels" => [],
        ];

        if ($tour->arHotels instanceof Collection) {
            foreach ($tour->arHotels as $hotel) {
                $arResult['countries'][$hotel->city->country->id] = $hotel->city->country;
                $arResult['hotels'][$hotel->id] = $hotel;
                $arResult['cities'][$hotel->city->id] = $hotel->city;
            }
        }

        $galleries = $tour->galleries;
        foreach ($galleries as $gallery) {
            $gallery->resized_image = CImage::resize($gallery->img, 250, 150);
        }

        $content = view('tour_content')->with(compact('tour', 'arResult', 'galleries'));
        $this->vars = Arr::add($this->vars, 'content', $content);

        return $this->renderOutput();



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
