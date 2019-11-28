<?php
namespace App\Repositories;
use App\Models\Hotel as Model;
use Illuminate\Support\Str;
use Config;
use Image;
use App\Lib\File\ImageUploader;

class HotelsRepository extends Repository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllWithPaginate ($paginate = false)
    {
        $columns = ['id', 'title', 'img',  'price', 'detail_text', 'city_id'];

        $result = $this->startConditions()->
        select($columns)
            ->orderBy('id', 'ASC')
            ->paginate($paginate);

        return $result;
    }

    public function getAll ()
    {
        $columns = ['id', 'title', 'img',  'price', 'detail_text', 'city_id'];

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

    public function addHotels($request)
    {
        $data = $request->except('_token');

        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageHelper = new ImageUploader($image);
            if ($imageHelper->checkMimeType()) {
                $imagePath = $imageHelper->save('/storage/images/hotels');
                $data['img'] = $imagePath;
            } else {
                return ['error' => 'Доступны только jpg и png форматы изображений'];
            }
        } else {
            return ['error' => 'Картинка не загружена!'];
        }

        if ($this->model->fill($data)->save()) {
            return ['status' => 'Отель добавлен'];
        }


    }

    public function updateHotels($request, $hotel)
    {
        $data = $request->except('_token', '_method');

        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageHelper = new ImageUploader($image);
            if ($imageHelper->checkMimeType()) {
                $imagePath = $imageHelper->save('/storage/images/hotels');
                $data['img'] = $imagePath;
                $oldImageFile = $hotel->img;
                if (!empty($oldImageFile) && file_exists($_SERVER['DOCUMENT_ROOT']. $oldImageFile)) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . $oldImageFile);
                }
            } else {
                return ['error' => 'Доступны только jpg и png форматы изображений'];
            }
        }

        $hotel->fill($data);


        if ($hotel->update()) {
            return ['status' => 'Отель обновлен'];
        }


    }

    public function deleteHotels ($hotel)
    {
        if ($hotel->delete()) {
            return ['status' => 'Отель удалена'];
        }
    }


}