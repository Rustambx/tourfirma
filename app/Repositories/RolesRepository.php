<?php
namespace App\Repositories;
use App\Models\Role as Model;
use Illuminate\Support\Str;
use Config;
use Image;

class RolesRepository extends Repository
{
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

    public function getAllWithPaginate ($paginate = false)
    {
        $columns = ['id', 'name'];

        $result = $this->startConditions()->
        select($columns)
            ->orderBy('id', 'ASC')
            ->paginate($paginate);

        return $result;
    }
}