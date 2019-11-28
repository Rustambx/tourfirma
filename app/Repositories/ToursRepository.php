<?php
namespace App\Repositories;
use App\Lib\File\ImageUploader;
use App\Models\Gallery;
use App\Models\Tour as Model;
use Image;
use Illuminate\Support\Str;
use Config;

class ToursRepository extends Repository
{


    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllWithPaginate ($paginate = false)
    {
        $columns = ['id', 'title', 'img',  'price', 'detail_text', 'type_tour_id'];

        $result = $this->startConditions()->
        select($columns)
            ->orderBy('id', 'ASC')
            ->paginate($paginate);

        return $result;
    }

    public function getAll ()
    {
        $columns = ['id', 'title', 'img',  'price', 'detail_text', 'type_tour_id'];

        $result = $this->startConditions()->
        select($columns)
            ->orderBy('id', 'ASC')->get();

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

    //TODO убрать
    public function one ($id)
    {
        $result = $this->startConditions()->find($id);

        return $result;
    }

    //TODO убрать
    public function getEdit ($id)
    {
        $result = $this->startConditions()->find($id);
        return $result;

    }

    public function addTours($request)
    {
        $data = $request->except('_token', 'hotel_id');
        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageHelper = new ImageUploader($image);
            if ($imageHelper->checkMimeType()) {
                $imagePath = $imageHelper->save('/storage/images/tours');
                $data['img'] = $imagePath;
            } else {
                return ['error' => 'Доступны только jpg и png форматы изображений'];
            }
        } else {
            return ['error' => 'Картинка не загружена!'];
        }


        $tour = new Model();
        if ($tour->fill($data)->save()) {
            if ($request->get('hotel_id')) {
                $tour->hotels()->attach($request->get('hotel_id'));
            }
            return ['status' => 'Тур добавлен'];

        }
    }

    public function updateTours($request, $tour)
    {
        $data = $request->except('_token', '_method', 'hotel_id');

        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        if (!isset($data['hot']) || $data['hot'] != 'Y') {
            $data['hot'] = 'N';
        } else {
            $data['hot'] = 'Y';
        }

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageHelper = new ImageUploader($image);
            if ($imageHelper->checkMimeType()) {
                $imagePath = $imageHelper->save('/storage/images/tours');
                $data['img'] = $imagePath;
                $oldImageFile = $tour->img;
                if (!empty($oldImageFile) && file_exists($_SERVER['DOCUMENT_ROOT']. $oldImageFile)) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . $oldImageFile);
                }
            } else {
                return ['error' => 'Доступны только jpg и png форматы изображений'];
            }
        }

        $tour->fill($data);

        if ($tour->update()) {
            if ($request->get('hotel_id') > 0) {
                $tour->hotels()->sync($request->get('hotel_id'));
            }
            return ['status' => 'Тур обновлен'];
        }


    }

    public function deleteTours ($tour)
    {
        $tour->hotels()->detach();

        if ($tour->delete()) {
            return ['status' => 'Тур удален'];
        }
    }
}