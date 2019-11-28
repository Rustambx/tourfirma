<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CountryRequest;
use App\Models\Country;
use App\Repositories\CountriesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use App\Lib\File\CImage;

class CountriesController extends AdminController
{
    protected $country_rep;

    public function __construct()
    {
        $this->template = 'admin.countries';
        $this->country_rep = app(CountriesRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('VIEW_ADMIN_COUNTRIES')) {
            abort(403);
        }
        $countries = $this->country_rep->getAllWithPaginate();
        foreach ($countries as $country){
            if ($country->img) {
                $country->resized_image = CImage::resize($country->img, 300, 364);
            }
        }
        $this->content = view('admin.countries_content')->with(compact('countries'));

        return $this->renderOutput();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('save', new Country())) {
            abort(403);
        }

        $title = 'Добавления стран';

        $this->content = view('admin.countries_create_content')->with(compact('title'));

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        if (Gate::denies('save', new Country())) {
            abort(403);
        }

        $result = $this->country_rep->addCountries($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.countries.index')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('edit', new Country())) {
            abort(403);
        }

        $country = $this->country_rep->one($id);
        if ($country->img) {
            $country->resized_image = CImage::resize($country->img, 500, 300);
        }
        $title = 'Изменения страны';
        $this->content = view('admin.countries_create_content')->with(compact('country', 'title'));

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, $id)
    {
        if (Gate::denies('update', new Country())) {
            abort(403);
        }

        $country = $this->country_rep->getEdit($id);

        $result = $this->country_rep->updateCountries($request, $country);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result['error']);
        }

        return redirect()->route('admin.countries.index')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('delete', new Country())) {
            abort(403);
        }

        $country = $this->country_rep->one($id);
        $result = $this->country_rep->deleteCountries($country);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result['error']);
        }

        return redirect()->route('admin.countries.index')->with($result);
    }
}
