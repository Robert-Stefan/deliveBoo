<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Type;

class RestaurantController extends Controller
{
    /**
     * Get Types
     */
    public function resType() {
        $restaurants = Restaurant::all();
        // Get types of restaurants in DB
        $types=[];
        foreach ($restaurants as $res){
            foreach($res->types as $type){
                if(!in_array($type->name, $types)){
                    $types[] = $type->name;
                }
            }
        }
        return response()->json($types);
    }
    
    /**
     * Get All Restaurants for Home
     */
    public function list() {
        $restaurants = Restaurant::paginate(3);

        // Set type attribute
        foreach ($restaurants as $res){
            $temp = [];
            foreach($res->types as $type){
                $temp[] = $type->name;
            }
            $res['type'] = $temp;
        }
        
        // Set image path
        foreach($restaurants as $restaurant) {
            if($restaurant->image) {
                $restaurant->image = url('storage/' . $restaurant->image);
            }
        }
        
        return response()->json($restaurants);
    }

    /**
     * Filter Restaurants by query string
     */
    public function filter(Request $request) {
        //Get query sring
        $typology = $request->input('types');
        // Turn query string into array
        $setType = json_decode($typology, true);

        // InnerJoin between restaurants, restaurant_type and types, filtered by setType array
        $restaurants = Restaurant::select('restaurants.*')
                            ->join('restaurant_type', 'restaurants.id', '=', 'restaurant_type.restaurant_id')
                            ->join('types', 'restaurant_type.type_id' ,'=', 'types.id')
                            ->whereIn('types.name', $setType)
                            ->groupBy('restaurants.id')->paginate(3);

        // Set type attribute
        foreach ($restaurants as $res){
            $temp = [];
            foreach($res->types as $type){
                $temp[] = $type->name;
            }
            $res['type'] = $temp;
        }

        // Set image path
        foreach($restaurants as $restaurant) {
            if($restaurant->image) {
                $restaurant->image = url('storage/' . $restaurant->image);
            }
        }
        
        return response()->json($restaurants);
    }

    public function show($slug) {
        $restaurant = Restaurant::where('slug', $slug)->with('types')->first();

        $temp = [];
        foreach($restaurant->types as $type){
            $temp[] = $type->name;
        }
        $restaurant['type'] = $temp;

        $restaurant->image = url('storage/' . $restaurant->image);
        return response()->json($restaurant);
    }
}
