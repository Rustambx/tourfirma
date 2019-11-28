<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GalleryRequest;
use App\Lib\File\CImage;
use App\Models\Gallery;
use App\Repositories\GalleriesRepository;
use App\Repositories\ToursRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;

class GalleriesController extends AdminController
{
    protected $gal_rep;
    protected $tour_rep;

    public function __construct()
    {
        $this->template = 'admin.galleries';
        $this->gal_rep = app(GalleriesRepository::class);
        $this->tour_rep = app(ToursRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('VIEW_ADMIN_GALLERIES')) {
            abort(403);
        }
        $galleries = $this->getGalleries();
        $this->content = view('admin.galleries_content')->with(compact('galleries'));

        return $this->renderOutput();
    }

    public function getGalleries ()
    {
        $galleries = $this->gal_rep->getAll();
        foreach ($galleries as $gallery) {
            $gallery->resized_image = CImage::resize($gallery->img, 500, 300);
        }

        return $galleries;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('save', new Gallery())) {
            abort(403);
        }
        $tours = $this->tour_rep->getAll();
        $title = 'Добавления галереи';
        $this->content = view('admin.galleries_create_content')->with(compact('tours', 'title'));

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        if (Gate::denies('save', new Gallery())) {
            abort(403);
        }
        $result = $this->gal_rep->addGalleries($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result['error']);
        }

        return redirect()->route('admin.galleries.index')->with($result);
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
        if (Gate::denies('edit', new Gallery())) {
            abort(403);
        }
        $gallery = $this->gal_rep->one($id);
        if ($gallery->img) {
            $gallery->resized_image = CImage::resize($gallery->img, 500, 300);
        }
        $tours = $this->tour_rep->getAll();
        $title = 'Изменения галереи';
        $this->content = view('admin.galleries_create_content')->with(compact('gallery', 'tours', 'title'));

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, $id)
    {
        if (Gate::denies('update', new Gallery())) {
            abort(403);
        }
        $gallery = $this->gal_rep->one($id);
        $result = $this->gal_rep->updateGalleries($request, $gallery);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result['error']);
        }

        return redirect()->route('admin.galleries.index')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('delete', new Gallery())) {
            abort(403);
        }
        $gallery = $this->gal_rep->one($id);
        $result = $this->gal_rep->deleteGalleries($gallery);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result['error']);
        }

        return redirect()->route('admin.galleries.index')->with($result);

    }
}
