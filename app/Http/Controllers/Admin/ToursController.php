<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TourRequest;
use App\Lib\File\CImage;
use App\Models\Tour;
use App\Models\Typetour;
use App\Repositories\CitiesRepository;
use App\Repositories\HotelsRepository;
use App\Repositories\ToursRepository;
use App\Type_tour;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;

class ToursController extends AdminController
{
    protected $tour_rep;
    protected $hotel_rep;
    protected $city_rep;

    public function __construct()
    {
        $this->title = 'Список туров';
        $this->template = 'admin.tours';
        $this->tour_rep = app(ToursRepository::class);
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
        if (Gate::denies('VIEW_ADMIN_TOURS')) {
            abort(403);
        }

        $tours = $this->tour_rep->getAllWithPaginate();

        // resize
        foreach ($tours as &$tour) {
            if ($tour->img) {
                $tour->resized_image = CImage::resize($tour->img, 275, 275);
            }
        }

        $this->content = view('admin.tours_content')->with(compact('tours'));

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('save', new Tour())) {
            abort(403);
        }

        $title = 'Добавления тура';
        $hotels = $this->hotel_rep->getAll();
        $typeTours = Type_tour::all();

        $this->content = view('admin.tours_create_content')->with(compact('hotels', 'cities', 'typeTours', 'title'));

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourRequest $request)
    {
        if (Gate::denies('save', new Tour())) {
            abort(403);
        }

        $result = $this->tour_rep->addTours($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.tours.index')->with($result);
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
        if (Gate::denies('edit', new Tour())) {
            abort(403);
        }

        $title = 'Изменения тура';
        $tour = $this->tour_rep->one($id);
        $hotels = $this->hotel_rep->getAll();
        $typeTours = Type_tour::all();
        $this->content = view('admin.tours_create_content')->with(compact('tour', 'hotels', 'cities', 'typeTours', 'title'));

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TourRequest $request, $id)
    {
        if (Gate::denies('update', new Tour())) {
            return back()->with(['error' => 'У вас нет прав для изменения']);
        }

        $tour = $this->tour_rep->getEdit($id);
        $result = $this->tour_rep->updateTours($request, $tour);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result['error']);
        }

        return redirect()->route('admin.tours.index')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('delete', new Tour())) {
            return back()->with(['error' => 'У вас нет прав для удаления']);
        }

        $tour = $this->tour_rep->getEdit($id);
        $files = glob($tour->img.'*'); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file))
                unlink($file); // delete file
        }
        $result = $this->tour_rep->deleteTours($tour);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result['error']);
        }

        return redirect()->route('admin.tours.index')->with($result);


    }
}
