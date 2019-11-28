<?php

namespace App\Http\Controllers;

use App\Repositories\CountriesRepository;
use App\Repositories\MenusRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Lib\File\CImage;

class CountriesController extends SiteController
{
    protected $country_rep;

    public function __construct(MenusRepository $navigation)
    {
        parent::__construct($navigation);
        $this->template = 'countries';
        $this->country_rep = app(CountriesRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = $this->country_rep->getAllWithPaginate();

        foreach ($countries as $country){
            if ($country->img) {
                $country->resized_image = CImage::resize($country->img, 300, 364);
            }
        }

        $content = view('countries_content')->with(compact('countries'));
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
//        $countries = $this->country_rep->getAllWithPaginate();
        $country = $this->country_rep->one($id);
        $arResult = [
            "cities" => [],
            "hotels" => [],
            "tours" => []
        ];

        if ($country->city instanceof Collection) {
            foreach ($country->city as $city) {
                $arResult['cities'][$city->id] = $city;
                if ($city->arHotels instanceof Collection) {
                    foreach ($city->arHotels as $hotel) {
                        $arResult['hotels'][$hotel->id] = $hotel;
                        if ($hotel->arTours instanceof Collection) {
                            foreach ($hotel->arTours as $tour) {
                                $arResult['tours'][$tour->id] = $tour;
                            }
                        }
                    }
                }
            }
        }

        $content = view('country_content')->with(compact('country', 'arResult'));
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
