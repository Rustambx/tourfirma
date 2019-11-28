<?php
namespace App\Repositories;

use App\Models\Menu as Model;

class MenusRepository extends Repository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllWithPaginate ()
    {
        $columns = ['id', 'title', 'path', 'routeName'];

        $result = $this->startConditions()->
        select($columns)
            ->orderBy('id', 'ASC')
            ->paginate(25);


        return $result;
    }

    public function getAll ()
    {
        $columns = ['id', 'title', 'path', 'routeName'];

        $result = $this->startConditions()->
        select($columns)
            ->orderBy('id', 'ASC')->get();

        return $result;
    }

    public function one ($id)
    {
        return $this->startConditions()->find($id);
    }

    public function addMenus ($request)
    {
        $data = $request->except('_token');

        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        if ($this->model->fill($data)->save()) {
            return ['status' => 'Меню добавлен'];
        }
    }

    public function updateMenus ($request, $menu)
    {
        $data = $request->except('_token', '_method');

        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        $menu->fill($data);

        if ($menu->update()) {
            return ['status' => 'Меню обновлен'];
        }
    }
}