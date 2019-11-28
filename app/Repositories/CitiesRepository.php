<?php
namespace App\Repositories;
use App\Models\City as Model;
use Illuminate\Support\Str;
use Config;
use Image;
use App\Lib\File\ImageUploader;

class CitiesRepository extends Repository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllWithPaginate ($paginate = false)
    {
        $columns = ['id', 'title', 'img',  'preview_text', 'detail_text', 'country_id'];

        $result = $this->startConditions()->
        select($columns)
            ->orderBy('id', 'ASC')
            ->paginate($paginate);


        return $result;
    }

    public function getAll ()
    {
        $columns = ['id', 'title', 'img',  'preview_text', 'detail_text', 'country_id'];

        $result = $this->startConditions()->
        select($columns)
            ->orderBy('id', 'ASC')->get();

        return $result;
    }

    public function getForComboBox ()
    {
        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", title) AS id_title'
        ]);

        $result = $this->startConditions()->selectRaw($columns)->toBase()->get();
        return $result;
    }

    public function one ($id)
    {
        $result = $this->startConditions()->find($id);

        return $result;

    }

    public function addCities($request)
    {
        $data = $request->except('_token');

        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageHelper = new ImageUploader($image);
            if ($imageHelper->checkMimeType()) {
                $imagePath = $imageHelper->save('/storage/images/cities');
                $data['img'] = $imagePath;
            } else {
                return ['error' => 'Доступны только jpg и png форматы изображений'];
            }
        } else {
            return ['error' => 'Картинка не загружена!'];
        }

        if ($this->model->fill($data)->save()) {
            return ['status' => 'Город добавлен'];
        }



    }

    public function updateCities($request, $city)
    {
        $data = $request->except('_token', '_method');

        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageHelper = new ImageUploader($image);
            if ($imageHelper->checkMimeType()) {
                $imagePath = $imageHelper->save('/storage/images/cities');
                $data['img'] = $imagePath;
                $oldImageFile = $city->img;
                if (!empty($oldImageFile) && file_exists($_SERVER['DOCUMENT_ROOT']. $oldImageFile)) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . $oldImageFile);
                }
            } else {
                return ['error' => 'Доступны только jpg и png форматы изображений'];
            }
        }

        $city->fill($data);


        if ($city->update()) {
            return ['status' => 'Город обновлен'];
        }


    }

    public function deleteCities($city)
    {
        if ($city->delete()) {
            return ['status' => 'Город удален'];
        }
    }
}