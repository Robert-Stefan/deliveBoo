<?php

namespace App\Http\Controllers\Admin;

use App\Dish;
use App\Http\Controllers\Controller;
use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        // dd($user->restaurant->id);
        $restaurant = Restaurant::find($user->restaurant->id);
        // dd($restaurant);
        $dishes = Dish::where('restaurant_id', $restaurant->id)->orderBy('name')->get();

        return view('admin.dishes.index', compact('dishes', 'restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dishes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:50',
                'ingredients' => 'required',
                'description' => 'required',
                'price' => 'required|numeric|max:999',
                'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            ],
            [
                'required' => 'The :attribute is required!!!',
                'max' => 'Max :max characters allowed for the :attribute',
            ]
        );


        $data = $request->all();
        $data['restaurant_id'] = Auth::user()->restaurant->id;

        if (array_key_exists('visibility', $data)) {
            $data['visibility'] = 1;
        } else {
            $data['visibility'] = 0;
        }

        // Image
        if (array_key_exists('image', $data)) {
            $data['image'] = Storage::put('dishes-images', $data['image']);
        };

        $new_dish = new Dish();

        $new_dish->fill($data);
        $new_dish->save();

        return redirect()->route('admin.dishes.show', $new_dish->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dish = Dish::find($id);

        if (!$dish) {
            abort(404);
        } elseif (Auth::user()->restaurant->id != $dish->restaurant_id) {
            abort(403);
        }
        return view('admin.dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dish = Dish::find($id);
        if (!$dish) {
            abort(404);
        } elseif (Auth::user()->restaurant->id != $dish->restaurant_id) {
            abort(403);
        }
        return view('admin.dishes.edit', compact('dish'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|max:50',
                'ingredients' => 'required',
                'description' => 'required',
                'price' => 'required|numeric|max:999',
                'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            ],
            [
                'required' => 'The :attribute is required!!!',
                'max' => 'Max :max characters allowed for the :attribute',
            ]
        );

        $data = $request->all();

        if (array_key_exists('visibility', $data)) {
            $data['visibility'] = 1;
        } else {
            $data['visibility'] = 0;
        }

        $dish = Dish::find($id);

        // Image update
        if (array_key_exists('image', $data)) {
            // delete previous one
            if ($dish->image) {
                Storage::delete($dish->image);
            }
            // set new one
            $data['image'] = Storage::put('dishes-images', $data['image']);
        }

        $dish->update($data);

        return redirect()->route('admin.dishes.show', $dish->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dish = Dish::find($id);
        $dish->orders()->detach();

        // Remove image if exists
        if ($dish->image) {
            Storage::delete($dish->image);
        }

        $dish->delete();
        return redirect()->route('admin.dishes.index')->with('deleted', $dish->name);
    }
}
