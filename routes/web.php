<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// ROUTE ADMIN
Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function() {

        // ROUTE HOME ADMIN
        Route::get('/', 'HomeController@index')->name('home');

        // ROUTE RESOURCE DISHES
        Route::resource('/dishes', 'DishController');

        // ROUTE RESTAURANT
        Route::resource('/restaurants', 'RestaurantController');

        // ROUTE ORDERS
        Route::resource('/orders', 'OrderController');

        //ROUTE CHARTS  
        Route::resource('/charts', 'ChartController');
    });

//FRONT OFFICE
Route::get('{any?}', function () {
    return view('guest.home');
})->where("any", ".*");