<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Menu;
use App\Models\Navigation;
use App\Models\Tour;
use App\Models\Typetour;
use App\Repositories\MenusRepository;
use App\Repositories\NewsRepository;
use App\Repositories\SlidersRepository;
use App\Repositories\ToursRepository;
use App\Type_tour;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Lib\File\CImage;

class IndexController extends SiteController
{
    protected $tour_rep;
    protected $news_rep;
    protected $sliders_rep;

    public function __construct()
    {
        parent::__construct(new MenusRepository( new Menu()));
        $this->template = 'index';
        $this->tour_rep = app(ToursRepository::class);
        $this->news_rep = app(NewsRepository::class);
        $this->sliders_rep = app(SlidersRepository::class);

    }

    public function index ()
    {
        $countries = Country::all();
        $typeTours = Type_tour::all();
        $countryIndex = view('countryIndex')->with(compact('countries', 'typeTours'));
        $this->vars = Arr::add($this->vars, 'countryIndex', $countryIndex);

        $tourItems = $this->getTours();
        $tourIndex = view('tourIndex')->with(compact('tourItems'));
        $this->vars = Arr::add($this->vars, 'tourIndex', $tourIndex);

        $newsItems = $this->getNews();
        $newsIndex = view('newsIndex')->with(compact('newsItems'));
        $this->vars = Arr::add($this->vars, 'newsIndex', $newsIndex);

        $slidersItems = $this->getSliders();
        $sliderIndex = view('sliders')->with(compact('slidersItems'));
        $this->vars = Arr::add($this->vars, 'sliderIndex', $sliderIndex);




        return $this->renderOutput();


    }

    public function getTours ()
    {
        $tours = Tour::where('hot', 'Y')->take(3)->get();

        foreach ($tours as $tour){
            if ($tour->img) {
                $tour->resized_image = CImage::resize($tour->img, 300, 364);
            }
        }

        return $tours;
    }

    public function getNews ()
    {
        $newItems = $this->news_rep->getAllWithPaginate(3);

        return $newItems;
    }

    public function getSliders ()
    {
        $sliderItems = $this->sliders_rep->getAllWithPaginate(3);

        return $sliderItems;
    }
}
