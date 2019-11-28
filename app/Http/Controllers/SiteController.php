<?php

namespace App\Http\Controllers;

use App\Repositories\MenusRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Menu;
use Carbon\Carbon;

class SiteController extends Controller
{
    protected $template;
    protected $navigation;
    protected $vars = [];


    public function __construct (MenusRepository $navigation)
    {
        $this->navigation = $navigation;
    }

    protected function renderOutput ()
    {
        $menu = $this->getMenu();

        $routName = \Request::route()->getName();
        $routFirstName = preg_replace('/(\w+)(\.)?.*/', '$1', $routName);

        $navigation = view('navigation')->with(compact('menu', 'routFirstName'));


        $this->vars = Arr::add($this->vars, 'navigation', $navigation);

        return view($this->template)->with($this->vars);

    }

    public function getMenu ()
    {
        $menu = $this->navigation->getAllWithPaginate();

        /*$mBuilder = Menu::make('MyNav', function ($m) use ($menu) {
            foreach ($menu as $item) {
                $m->add($item->title, $item->path);
            }
        });*/

        return $menu;
    }
}
