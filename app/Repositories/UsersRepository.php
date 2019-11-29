<?php
namespace App\Repositories;
use App\User as Model;
use Image;
use Illuminate\Support\Str;
use Config;
use Gate;

class UsersRepository extends Repository
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = app($this->getModelClass());
    }


    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAll ()
    {
        $columns = ['id', 'name', 'login', 'email', 'password'];

        $result = $this->startConditions()->
        select($columns)
            ->orderBy('id', 'ASC')->get();

        return $result;
    }

    public function getAllWithPaginate($paginate = false)
    {
        $columns = ['id', 'title', 'img', 'price', 'detail_text'];

        $result = $this->startConditions()->
        select($columns)
            ->orderBy('id', 'ASC')
            ->paginate($paginate);

        return $result;
    }

    public function one ($id)
    {
        $result = $this->startConditions()->find($id);
        return $result;

    }

    public function addUser ($request)
    {
        if (Gate::denies('create', $this->model)) {
            abort(403);
        }
        $data = $request->all();
        $user = $this->model->create([
            'name' => $data['name'],
            'login' => $data['login'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        if ($user) {
            $user->roles()->attach($data['role_id']);
        }

        return ['status' => 'Ползователь добавлен'];


    }

    public function updateUser ($request, $user)
    {
        if (Gate::denies('edit', $this->model)) {
            abort(403);
        }

        $data = $request->except('_token', '_method', 'role_id');
        if (!empty($data['password'])) {
            if ($data['password'] == $data['password_confirmation']) {
                $data['password'] = bcrypt($data['password']);
            } else {
                return ["error" => "Вы неправильно повторили пароль"];
            }
        } else {
            unset($data['password']);
        }
        $user->fill($data);
        if ($user->update()){
            $user->roles()->sync($request->get('role_id'));
        }


        return ['status' => 'Пользователь изменен'];
    }

    public function deleteUser ($user)
    {
        $user->roles()->detach();

        if ($user->delete()) {
            return ['status' => 'Пользователь удален'];
        }
    }
}