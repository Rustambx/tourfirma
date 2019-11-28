<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use App\Repositories\MenusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenusController extends AdminController
{
    protected $menus_rep;

    public function __construct()
    {
        $this->template = 'admin.menus';
        $this->menus_rep = app(MenusRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = $this->menus_rep->getAllWithPaginate();
        $this->content = view('admin.menus_content')->with(compact('menus'));

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Добавления меню';
        $this->content = view('admin.menus_create_content')->with(compact('title'));
        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $result = $this->menus_rep->addMenus($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result['error']);
        }

        return redirect()->route('admin.menus.index')->with($result);
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
        $menu = $this->menus_rep->one($id);
        $title = 'Изменения меню';
        $this->content = view('admin.menus_create_content')->with(compact('menu', 'title'));
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, $id)
    {
        $menu = $this->menus_rep->one($id);
        $result = $this->menus_rep->updateMenus($request, $menu);

        if (is_array($result) && !empty($result['error'])){
            return back()->with($result['error']);
        }

        return redirect()->route('admin.menus.index')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Menu::destroy($id);

        if ($result) {
            return redirect()->route('admin.menus.index')->with(['status' => 'Меню удален']);
        } else {
            return back()->with(['error' => 'Ошибка удаления']);
        }
    }
}
