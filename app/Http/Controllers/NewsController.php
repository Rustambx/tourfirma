<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Repositories\CountriesRepository;
use App\Repositories\MenusRepository;
use App\Repositories\NewsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class NewsController extends SiteController
{
    protected $news_rep;

    public function __construct(MenusRepository $navigation)
    {
        parent::__construct($navigation);
        $this->template = 'news';
        $this->news_rep = app(NewsRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = $this->news_rep->getAllWithPaginate();
        $content = view('news_content')->with(compact('news'));
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
        $new = $this->news_rep->one($id);
        $content = view('new_content')->with(compact('new'));
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
