<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Repositories\RolesRepository;
use App\Repositories\UsersRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;

class UsersController extends AdminController
{
    protected $user_rep;
    protected $role_rep;

    public function __construct()
    {
        $this->user_rep = app(UsersRepository::class);
        $this->role_rep = app(RolesRepository::class);
        $this->template = 'admin.users';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('VIEW_ADMIN_USERS')) {
            abort(403);
        }

        $users = $this->user_rep->getAll();

        $this->content = view('admin.users_content')->with(compact('users'));

        return $this->renderOutput();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('save', new User())) {
            return back()->with(['error' => 'У вас нет прав для добавления']);
        }
        $title = 'Добавления пользователя';
        $roles = $this->role_rep->getAll();
        $this->content = view('admin.users_create_content')->with(compact('roles', 'title'));

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if (Gate::denies('save', new User())) {
            return back()->with(['error' => 'У вас нет прав для добавления']);
        }

        $result = $this->user_rep->addUser($request);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect()->route('admin.users.index')->with($result);
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
        if (Gate::denies('edit', new User())) {
            return back()->with(['error' => 'У вас нет прав для изменения']);
        }

        $title = 'Изменения пользователя';
        $roles = $this->role_rep->getAll();
        $user = $this->user_rep->one($id);
        $this->content = view('admin.users_create_content')->with(compact('roles', 'user', 'title'));

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        if (Gate::denies('update', new User())) {
            return back()->with(['error' => 'У вас нет прав для изменения']);
        }

        $user = $this->user_rep->one($id);
        $result = $this->user_rep->updateUser($request, $user);

        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect()->route('admin.users.index')->with($result);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Gate::denies('delete', new User())){
            return back()->with(['error' => 'У вас нет прав для удаления']);
        }
        $result = $this->user_rep->deleteUser($user);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result['error']);
        }

        return redirect()->route('admin.users.index')->with($result);
    }
}
