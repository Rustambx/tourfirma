<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\PermissionsRepository;
use App\Repositories\RolesRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;

class PermissionsController extends AdminController
{
    protected $role_rep;
    protected $perm_rep;

    public function __construct()
    {
        $this->role_rep = app(RolesRepository::class);
        $this->perm_rep = app(PermissionsRepository::class);

        $this->template = 'admin.permissions';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('CHANGE_PERMISSIONS')) {
            return back()->with(['error' => 'У вас нет прав для изменения']);
        }

        $roles = $this->role_rep->getAllWithPaginate();
        $permissions = $this->perm_rep->getAll();
        $this->content = view('admin.permissions_content')->with(compact('roles', 'permissions'));

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
        $result = $this->perm_rep->changePermissions($request);
        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return back()->with($result);
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
