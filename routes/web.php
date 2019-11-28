<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index')->name('index');

Route::resource('tours', 'ToursController')->names('tours');
Route::resource('countries', 'CountriesController')->names('countries');
Route::resource('hotels', 'HotelsController')->names('hotels');
Route::resource('cities', 'CitiesController')->names('cities');
Route::resource('news', 'NewsController')->names('news');
Route::match(['get', 'post'], '/contacts', ['uses' => 'ContactsController@index', 'as'=>'contacts']);
Route::match(['get', 'post'],'/ajax', ['uses' => 'AjaxCityController@getCities', 'as' => 'ajax']);

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'],function() {
    Route::get('/', ['uses' => 'IndexController@index', 'as' => 'adminIndex']);

    Route::resource('tours', 'ToursController')->names('admin.tours');
    Route::resource('hotels', 'HotelsController')->names('admin.hotels');
    Route::resource('countries', 'CountriesController')->names('admin.countries');
    Route::resource('news', 'NewsController')->names('admin.news');
    Route::resource('cities', 'CitiesController')->names('admin.cities');
    Route::resource('menus', 'MenusController')->names('admin.menus');
    Route::resource('sliders', 'SlidersController')->names('admin.sliders');
    Route::resource('permissions', 'PermissionsController')->names('admin.permissions');
    Route::resource('users', 'UsersController')->names('admin.users');
    Route::resource('galleries', 'GalleriesController')->names('admin.galleries');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');


Route::get('/home', 'HomeController@index')->name('home');


Route::get('/home', 'HomeController@index')->name('home');
