<?php
namespace App\Repositories;
use App\Models\Slider as Model;
use Illuminate\Support\Str;
use Config;
use Image;
use App\Lib\File\ImageUploader;

class SlidersRepository extends Repository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllWithPaginate ($paginate = false)
    {
        $columns = ['id', 'title', 'img',  'price', 'country_id'];

        $result = $this->startConditions()->
        select($columns)
            ->orderBy('id', 'ASC')
            ->paginate($paginate);

        return $result;
    }

    public function getForComboBox ()
    {
        //return $this->startConditions()->all();
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

    public function getEdit ($id)
    {
        $result = $this->startConditions()->find($id);
        return $result;

    }


    public function addSliders($request)
    {
        $data = $request->except('_token');

        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageHelper = new ImageUploader($image);
            if ($imageHelper->checkMimeType()) {
                $imagePath = $imageHelper->save('/storage/images/sliders');
                $data['img'] = $imagePath;
            } else {
                return ['error' => 'Доступны только jpg и png форматы изображений'];
            }
        } else {
            return ['error' => 'Картинка не загружена!'];
        }

        if ($this->model->fill($data)->save()) {
            return ['status' => 'Баннер добавлен'];
        }


    }

    public function updateSliders($request, $slider)
    {
        $data = $request->except('_token', '_method');

        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageHelper = new ImageUploader($image);
            if ($imageHelper->checkMimeType()) {
                $imagePath = $imageHelper->save('/storage/images/sliders');
                $data['img'] = $imagePath;
                $oldImageFile = $slider->img;
                if (!empty($oldImageFile) && file_exists($_SERVER['DOCUMENT_ROOT']. $oldImageFile)) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . $oldImageFile);
                }
            } else {
                return ['error' => 'Доступны только jpg и png форматы изображений'];
            }
        }

        $slider->fill($data);


        if ($slider->update()) {
            return ['status' => 'Баннер обновлен'];
        }


    }

    public function deleteSliders($slider)
    {
        if ($slider->delete()) {
            return ['status' => 'Баннер удален'];
        }
    }
}