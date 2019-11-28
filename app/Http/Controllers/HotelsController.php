<?php

namespace App\Http\Controllers;

use App\Repositories\HotelsRepository;
use App\Repositories\MenusRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Lib\File\CImage;

class HotelsController extends SiteController
{
    protected $hotel_rep;

    public function __construct(MenusRepository $navigation)
    {
        parent::__construct($navigation);
        $this->template = 'hotels';
        $this->hotel_rep = app(HotelsRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = $this->hotel_rep->getAllWithPaginate();
        foreach ($hotels as $hotel){
            if ($hotel->img) {
                $hotel->resized_image = CImage::resize($hotel->img, 300, 364);
            }
        }
        $content = view('hotels_content')->with(compact('hotels'));
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
        $hotel = $this->hotel_rep->one($id);
        $content = view('hotel_content')->with(compact('hotel'));
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
