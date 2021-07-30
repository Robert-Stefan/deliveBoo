<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')->group(function() {
    // Get Types
    Route::get('/types', 'RestaurantController@resType');

    // Get Restaurants
    // All
    Route::get('/restaurants', 'RestaurantController@list');
    // Filter
    Route::get('/filter', 'RestaurantController@filter');
    // Single
    Route::get('/restaurants/{slug}', 'RestaurantController@show');

    // Get Dishes
    Route::get('/dishes/{id}', 'DishController@index');

    // Orders data
    Route::post('/orders', 'OrderController@store');
});
