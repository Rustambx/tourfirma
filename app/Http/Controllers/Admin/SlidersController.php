<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use App\Repositories\CountriesRepository;
use App\Repositories\SlidersRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use App\Lib\File\CImage;

class SlidersController extends AdminController
{
    protected $slider_rep;
    protected $country_rep;

    public function __construct()
    {
        $this->template = 'admin.sliders';
        $this->slider_rep = app(SlidersRepository::class);
        $this->country_rep = app(CountriesRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('VIEW_ADMIN_SLIDERS')) {
            abort(403);
        }


        $sliders = $this->slider_rep->getAllWithPaginate();
        foreach ($sliders as $slider){
            if ($slider->img) {
                $slider->resized_image = CImage::resize($slider->img, 500, 300);
            }
        }
        $this->content = view('admin.sliders_content')->with(compact('sliders'));

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('save', new Slider())) {
            return back()->with(['error' => 'У вас нет прав для добавления']);
        }

        $title = 'Добавления слайдера';
        $countries = $this->country_rep->getForComboBox();
        $this->content = view('admin.sliders_create_content')->with(compact('countries', 'title'));

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        if (Gate::denies('save', new Slider())) {
            return back()->with(['error' => 'У вас нет прав для добавления']);
        }

        $result = $this->slider_rep->addSliders($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result['error']);
        }

        return redirect()->route('admin.sliders.index')->with($result);
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
        if (Gate::denies('edit', new Slider())) {
            return back()->with(['error' => 'У вас нет прав для изменения']);
        }

        $title = 'Изменения слайдера';
        $slider = $this->slider_rep->one($id);
        if ($slider->img) {
            $slider->resized_image = CImage::resize($slider->img, 500, 300);
        }
        $countries = $this->country_rep->getForComboBox();
        $this->content = view('admin.sliders_create_content')->with(compact('countries', 'slider', 'title'));

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SliderRequest $request, $id)
    {
        if (Gate::denies('update', new Slider())) {
            return back()->with(['error' => 'У вас нет прав для изменения']);
        }

        $slider = $this->slider_rep->one($id);

        $result = $this->slider_rep->updateSliders($request, $slider);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result['error']);
        }

        return redirect()->route('admin.sliders.index')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('delete', new Slider())) {
            return back()->with(['error' => 'У вас нет прав для удаления']);
        }

        $slider = $this->slider_rep->getEdit($id);
        $result = $this->slider_rep->deleteSliders($slider);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result['error']);
        }

        return redirect()->route('admin.sliders.index')->with($result);
    }
}
