<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Menu;
use Auth;
use Gate;

class AdminController extends Controller
{

    protected $title;
    protected $content = false;
    protected $user;
    protected $template;
    protected $vars;

    public function __construct()
    {
        $this->middleware('auth');
    }


    protected function renderOutput ()
    {
        $this->vars = Arr::add($this->vars, 'title', $this->title);

        $menu = $this->getMenu();
        $user = Auth::user();
        $navigation = view('admin.navigation')->with(compact('menu', 'user'));
        $this->vars = Arr::add($this->vars, 'navigation', $navigation);

        $user = Auth::user();
        $breadcrumbs = view('admin.breadcrumbs')->with(compact('user'));
        $this->vars = Arr::add($this->vars, 'breadcrumbs', $breadcrumbs);


        if($this->content) {
            $this->vars = Arr::add($this->vars,'content',$this->content);
        }

        return view($this->template)->with($this->vars);


    }

    public function getMenu() {
        return Menu::make('adminMenu', function($menu) {

            if (!Gate::denies('VIEW_ADMIN_TOURS')) {
                $menu->add('Туры',  ['route'  => 'admin.tours.index']);
            }
            if (!Gate::denies('VIEW_ADMIN_GALLERIES')) {
                $menu->add('Галерея',  ['route'  => 'admin.galleries.index']);
            }
            if (!Gate::denies('VIEW_ADMIN_HOTELS')) {
                $menu->add('Отели',  ['route'  => 'admin.hotels.index']);
            }
            if (!Gate::denies('VIEW_ADMIN_COUNTRIES')) {
                $menu->add('Страны',  ['route'  => 'admin.countries.index']);
            }
            if (!Gate::denies('VIEW_ADMIN_CITIES')) {
                $menu->add('Городы',  ['route'  => 'admin.cities.index']);
            }
            if (!Gate::denies('VIEW_ADMIN_NEWS')) {
                $menu->add('Новости',  ['route'  => 'admin.news.index']);
            }
            if (!Gate::denies('VIEW_ADMIN_MENUS')) {
                $menu->add('Меню',  ['route'  => 'admin.menus.index']);
            }
            if (!Gate::denies('VIEW_ADMIN_SLIDERS')) {
                $menu->add('Слайдер',  ['route'  => 'admin.sliders.index']);
            }
            if (!Gate::denies('VIEW_ADMIN_USERS')) {
                $menu->add('Пользователи',  ['route'  => 'admin.users.index']);
            }
            if (!Gate::denies('CHANGE_PERMISSIONS')) {
                $menu->add('Привилегии',  ['route'  => 'admin.permissions.index']);
            }

        });
    }
}
