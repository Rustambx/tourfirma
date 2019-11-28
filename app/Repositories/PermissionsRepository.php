<?php
namespace App\Repositories;
use App\Models\Permission as Model;
use Illuminate\Support\Str;
use Config;
use Image;
use Gate;

class PermissionsRepository extends Repository
{
    protected $rol_rep;

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAll ()
    {
        $columns = ['id', 'name'];

        $result = $this->startConditions()->
        select($columns)
            ->orderBy('id', 'ASC')->get();

        return $result;
    }

    public function getAllWithPaginate (int $paginate = 25)
    {
        $columns = ['id', 'name'];

        $result = $this->startConditions()->
        select($columns)
            ->orderBy('id', 'ASC')
            ->paginate($paginate);

        return $result;
    }

    public function changePermissions ($request)
    {
        $this->rol_rep = app(RolesRepository::class);

        if (Gate::denies('CHANGE_PERMISSIONS')) {
            abort(403);
        }

        $data = $request->except('_token');
        $roles = $this->rol_rep->getAll();

        foreach ($roles as $role) {
            if (isset($data[$role->id])) {
                $role->savePermission($data[$role->id]);
            } else {
                $role->savePermission([]);
            }

        }
        return ['status' => 'Права обновлена'];



    }

}