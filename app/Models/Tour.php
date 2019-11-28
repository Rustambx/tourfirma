<?php

namespace App\Models;

use App\Type_tour;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = ['title', 'img', 'detail_text', 'price', 'city_id', 'hotel_id', 'type_tour_id', 'hot'];

    public function hotels ()
    {
        return $this->belongsToMany(Hotel::class, 'tour_hotel');
    }

    public function getArHotelsAttribute ()
    {
        $hotels = $this->hotels()->getResults();
        return $hotels;
    }

    public function getArTypeAttribute ()
    {
        $type = Type_tour::all()->where('id',  $this->type_tour_id);
        return $type;
    }

    public function city ()
    {
        return $this->belongsTo(City::class);
    }

    public function type ()
    {
        return $this->belongsTo(Type_tour::class, 'type_tour_id');
    }

    public function galleries ()
    {
        return $this->hasMany(Gallery::class);
    }


    protected static function boot()
    {
        parent::boot();
        /**
         * Удаление картинок и ресайзов
         */
        static::deleted (function ($model) {
            $realPath = public_path() . $model->img;
            if (file_exists($realPath)) {
                if (preg_match('/(.*?)(\w+)\.(\w+)$/', $model->img, $matches)) {
                    $files = glob(public_path() . $matches[1] . $matches[2] . '_resize_*');
                    if (is_array($files)) {
                        foreach ($files as $file) {
                            unlink($file);
                        }
                    }
                }
                unlink($realPath);
            }
        });
    }

}
