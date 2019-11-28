<?php

namespace App\Http\Controllers;

use App\Repositories\CitiesRepository;
use App\Repositories\MenusRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Collection;

class CitiesController extends SiteController
{
    protected $city_rep;

    public function __construct(MenusRepository $navigation)
    {
        parent::__construct($navigation);
        $this->template = 'cities';
        $this->city_rep = app(CitiesRepository::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $city = $this->city_rep->one($id);
        $arResult = [
            "hotels" => [],
            "tours" => []
        ];

        foreach ($city->arHotels as $hotel) {
            $arResult['hotels'][$hotel->id] = $hotel;
                foreach ($hotel->arTours as $tour) {
                    $arResult['tours'][$tour->id] = $tour;
            }
        }


        $content = view('city_content')->with(compact('city', 'arResult'));
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
