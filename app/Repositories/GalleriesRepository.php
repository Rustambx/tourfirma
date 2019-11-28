<?php
namespace App\Repositories;
use App\Models\Gallery as Model;
use App\Models\Gallery;
use App\User;
use Illuminate\Support\Str;
use Config;
use Image;
use App\Lib\File\ImageUploader;

class GalleriesRepository extends Repository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAll ()
    {
        $columns = ['id', 'name', 'img', 'tour_id'];

        $result = $this->startConditions()->
        select($columns)
            ->orderBy('id', 'ASC')->get();

        return $result;
    }


    public function one ($id)
    {
        $result = $this->startConditions()->find($id);

        return $result;

    }


    public function addGalleries($request)
    {
        $data = $request->except('_token');

        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageHelper = new ImageUploader($image);
            if ($imageHelper->checkMimeType()) {
                $imagePath = $imageHelper->save('/storage/images/galleries');
                $data['img'] = $imagePath;
            } else {
                return ['error' => 'Доступны только jpg и png форматы изображений'];
            }
        } else {
            return ['error' => 'Картинка не загружена!'];
        }

        if ($this->model->fill($data)->save()) {
            return ['status' => 'Галерея добавлена'];
        }


    }

    public function updateGalleries($request, $gallery)
    {
        $data = $request->except('_token', '_method');

        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageHelper = new ImageUploader($image);
            if ($imageHelper->checkMimeType()) {
                $imagePath = $imageHelper->save('/storage/images/galleries');
                $data['img'] = $imagePath;
                $oldImageFile = $gallery->img;
                if (!empty($oldImageFile) && file_exists($_SERVER['DOCUMENT_ROOT']. $oldImageFile)) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . $oldImageFile);
                }
            } else {
                return ['error' => 'Доступны только jpg и png форматы изображений'];
            }
        }

        $gallery->fill($data);


        if ($gallery->update()) {
            return ['status' => 'Галерея обновлена'];
        }


    }

    public function deleteGalleries($gallery)
    {
        if ($gallery->delete()) {
            return ['status' => 'Галерея удалена'];
        }
    }
}