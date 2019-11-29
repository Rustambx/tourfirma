<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\HotelRequest;
use App\Models\Hotel;
use App\Repositories\CitiesRepository;
use App\Repositories\HotelsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use App\Lib\File\CImage;

class HotelsController extends AdminController
{
    protected $hotel_rep;
    protected $city_rep;

    public function __construct()
    {
        $this->template = 'admin.hotels';
        $this->hotel_rep = app(HotelsRepository::class);
        $this->city_rep = app(CitiesRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('VIEW_ADMIN_HOTELS')) {
            abort(403);
        }

        $hotels = $this->hotel_rep->getAllWithPaginate();
        foreach ($hotels as $hotel){
            if ($hotel->img) {
                $hotel->resized_image = CImage::resize($hotel->img, 275, 275);
            }
        }

        $this->content = view('admin.hotels_content')->with(compact('hotels', 'title'));

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('save', new Hotel())) {
            abort(403);
        }

        $cities = $this->city_rep->getForComboBox();
        $title = 'Добавления отеля';
        $this->content = view('admin.hotels_create_content')->with(compact('cities', 'title'));

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HotelRequest $request)
    {
        if (Gate::denies('save', new Hotel())) {
            abort(403);
        }

        $result = $this->hotel_rep->addHotels($request);

        if (is_array($result) && !empty($result['error'])){
            return back()->with($result['error']);
        }

        return redirect()->route('admin.hotels.index')->with($result);
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
        if (Gate::denies('edit', new Hotel())) {
            abort(403);
        }

        $hotel = $this->hotel_rep->one($id);
        if ($hotel->img) {
            $hotel->resized_image = CImage::resize($hotel->img, 500, 300);
        }
        $cities = $this->city_rep->getForComboBox();
        $title = 'Добавления отеля';
        $this->content = view('admin.hotels_create_content')->with(compact('hotel', 'cities', 'title'));

        return $this->renderOutput();
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
        if (Gate::denies('update', new Hotel())) {
            return back()->with(['error' => 'У вас нет прав для изменения']);
        }

        $hotel = $this->hotel_rep->one($id);
        $result = $this->hotel_rep->updateHotels($request, $hotel);

        if (is_array($result) && !empty($result['error'])){
            return back()->with($result['error']);
        }

        return redirect()->route('admin.hotels.index')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('delete', new Hotel())) {
            return back()->with(['error' => 'У вас нет прав для удаления']);
        }

        $hotel = $this->hotel_rep->one($id);
        $result = $this->hotel_rep->deleteHotels($hotel);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result['error']);
        }

        return redirect()->route('admin.hotels.index')->with($result);
    }
}
