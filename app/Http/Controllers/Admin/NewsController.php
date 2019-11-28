<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Repositories\NewsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use App\Lib\File\CImage;

class NewsController extends AdminController
{
    protected $new_rep;

    public function __construct()
    {
        $this->template = 'admin.news';
        $this->new_rep = app(NewsRepository::class);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('VIEW_ADMIN_NEWS')) {
            abort(403);
        }

        $news = $this->new_rep->getAllWithPaginate();
        foreach ($news as $item){
            if ($item->img) {
                $item->resized_image = CImage::resize($item->img, 275, 275);
            }
        }
        $this->content = view('admin.news_content')->with(compact('news'));

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('edit', new News())) {
            abort(403);
        }

        $title = 'Добавления новостей';
        $this->content = view('admin.news_create_content')->with(compact('title'));

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        if (Gate::denies('save', new News())) {
            abort(403);
        }

        $result = $this->new_rep->addNews($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.news.index')->with($result);
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
        if (Gate::denies('edit', new News())) {
            abort(403);
        }

        $title = 'Изменения новостей';
        $new = $this->new_rep->one($id);

        if ($new->img) {
            $new->resized_image = CImage::resize($new->img, 400, 275);
        }

        $this->content = view('admin.news_create_content')->with(compact('new', 'title'));

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, $id)
    {
        if (Gate::denies('update', new News())) {
            abort(403);
        }

        $new = $this->new_rep->getEdit($id);
        $result = $this->new_rep->updateNews($request, $new);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result['error']);
        }

        return redirect()->route('admin.news.index')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('delete', new News())) {
            abort(403);
        }

        $new = $this->new_rep->getEdit($id);
        $result = $this->new_rep->deleteNews($new);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result['error']);
        }

        return redirect()->route('admin.news.index')->with($result);
    }
}
