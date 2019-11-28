<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Repositories\CitiesRepository;
use App\Repositories\CountriesRepository;
use App\Repositories\ToursRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use App\Lib\File\CImage;

class CitiesController extends AdminController
{
    protected $city_rep;
    protected $country_rep;
    protected $tour_rep;

    public function __construct()
    {
        $this->template = 'admin.cities';
        $this->city_rep = app(CitiesRepository::class);
        $this->country_rep = app(CountriesRepository::class);
        $this->tour_rep = app(ToursRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('VIEW_ADMIN_CITIES')) {
            abort(403);
        }
        $cities = $this->city_rep->getAllWithPaginate();
        foreach ($cities as $city){
            if ($city->img) {
                $city->resized_image = CImage::resize($city->img, 275, 275);
            }
        }
        $this->content = view('admin.cities_content')->with(compact('cities'));

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('edit', new City())) {
            abort(403);
        }

        $countries = $this->country_rep->getForComboBox();
        $title = 'Добавления города';
        $tours = $this->tour_rep->getForComboBox();
        $this->content = view('admin.cities_create_content')->with(compact('countries', 'tours', 'title'));

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        if (Gate::denies('save', new City())) {
            abort(403);
        }

        $result = $this->city_rep->addCities($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result['error']);
        }

        return redirect()->route('admin.cities.index')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('edit', new City())) {
            abort(403);
        }

        $city = $this->city_rep->one($id);
        if ($city->img) {
            $city->resized_image = CImage::resize($city->img, 275, 275);
        }
        $countries = $this->country_rep->getForComboBox();
        $title = 'Изменения города';
        $this->content = view('admin.cities_create_content')->with(compact('countries', 'city', 'title'));

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, $id)
    {
        if (Gate::denies('update', new City())) {
            abort(403);
        }

        $city = $this->city_rep->getEdit($id);

        $result = $this->city_rep->updateCities($request, $city);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result['error']);
        }

        return redirect()->route('admin.cities.index')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('delete', new City())) {
            abort(403);
        }

        $city = $this->city_rep->getEdit($id);
        $result = $this->city_rep->deleteCities($city);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result['error']);
        }

        return redirect()->route('admin.cities.index')->with($result);

    }
}
