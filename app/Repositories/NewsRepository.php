<?php
namespace App\Repositories;

use App\Models\News as Model;
use Illuminate\Support\Str;
use Config;
use Image;
use App\Lib\File\ImageUploader;

class NewsRepository extends Repository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllWithPaginate($paginate = false)
    {
        $columns = ['id', 'title', 'img', 'preview_text', 'detail_text', 'created_at'];

        $result = $this->startConditions()->
        select($columns)
            ->orderBy('id', 'ASC')
            ->paginate($paginate);

        return $result;
    }

    public function one($id)
    {
        $result = $this->startConditions()->find($id);

        return $result;

    }


    public function addNews($request)
    {
        $data = $request->except('_token');

        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageHelper = new ImageUploader($image);
            if ($imageHelper->checkMimeType()) {
                $imagePath = $imageHelper->save('/storage/images/news');
                $data['img'] = $imagePath;
            } else {
                return ['error' => 'Доступны только jpg и png форматы изображений'];
            }
        } else {
            return ['error' => 'Картинка не загружена!'];
        }

        if ($this->model->fill($data)->save()) {
            return ['status' => 'Новость добавлена'];
        }

    }

    public function updateNews($request, $new)
    {
        $data = $request->except('_token', '_method');

        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageHelper = new ImageUploader($image);
            if ($imageHelper->checkMimeType()) {
                $imagePath = $imageHelper->save('/storage/images/news');
                $data['img'] = $imagePath;
                $oldImageFile = $new->img;
                if (!empty($oldImageFile) && file_exists($_SERVER['DOCUMENT_ROOT']. $oldImageFile)) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . $oldImageFile);
                }
            } else {
                return ['error' => 'Доступны только jpg и png форматы изображений'];
            }
        }

        $new->fill($data);


        if ($new->update()) {
            return ['status' => 'Новость обновлена'];
        }


    }

    public function deleteNews($new)
    {
        if ($new->delete()){
            return ['status' => 'Новость удалена'];
        }
    }
}