<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Restaurant;
use App\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        if (!Auth::user()->restaurant) {
            return view('admin.restaurants.create', compact('types'));
        } else {
            return redirect()->route('admin.home');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // CONTROLLO PER UN SOLO RISTORANTI
        if (Auth::user()->restaurant) {
            return redirect()->route('admin.home');
        }

        $request->validate([
            'name' => 'required|unique:restaurants|max:30',
            'vat_number' => 'required|unique:restaurants|size:11',
            'address' => 'required|unique:restaurants|max:50',
            'types' => 'required|exists:types,id',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ], [
            'required' => 'The :attribute is required!!!',
            'unique' => 'The :attribute is already used',
            'max' => 'Max :max characters allowed for the :attribute',
        ]);

        $user = Auth::id();
        $data = $request->all();
        $data['user_id'] = $user;

        // Image
        if(array_key_exists('image', $data)){
            $data['image'] = Storage::put('restaurants-images', $data['image']);
        };

        // Slug
        $data['slug'] = Str::slug($data['name'], '-');

        $new_restaurant = new Restaurant();
        $new_restaurant->fill($data);

        $new_restaurant->save();

        if (array_key_exists('types', $data)) {
            $new_restaurant->types()->attach($data['types']);
        }


        return redirect()->route('admin.restaurants.show', $new_restaurant->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurant = Restaurant::find($id);

        if (!$restaurant) {
            abort(404);
        } elseif (Auth::user()->restaurant->id != $restaurant->id){
            abort(403);
        }

        return view('admin.restaurants.show', compact('restaurant'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $restaurant = Restaurant::find($id);
        $types = Type::all();

        if (!$restaurant) {
            abort(404);
        } elseif (Auth::user()->restaurant->id != $restaurant->id){
            abort(403);
        }

        return view('admin.restaurants.edit', compact('restaurant', 'types'));
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
                'name' => ["required", Rule::unique('restaurants')->ignore($id), 'max:30'],
                'vat_number' => ["required", Rule::unique('restaurants')->ignore($id), 'size:11'],
                'address' => ["required", Rule::unique('restaurants')->ignore($id), 'max:50'],
                'types' => 'required|exists:types,id',
                'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',

            ],
            [
                'required' => 'The :attribute is required!!!',
                'max' => 'Max :max characters allowed for the :attribute',
            ]
        );

        $data = $request->all();

        $restaurant = Restaurant::find($id);

        // Image update
        if(array_key_exists('image', $data)) {
            // delete previous one
            if($restaurant->image){
                Storage::delete($restaurant->image);
            }
            // set new one
            $data['image'] = Storage::put('restaurants-images', $data['image']);
        }
        
                //Slug
        if($data['name'] != $restaurant->name){
            $data['slug'] = Str::slug($data['name'], '-');
        }

        $restaurant->update($data);

        if(array_key_exists('types', $data)) {
            // aggiunta records tabella pivot 
            $restaurant->types()->sync($data['types']); // aggiunge / rimuove update
        } else {
            $restaurant->types()->detach(); // rimuove tutte le records nella pivot
        }

        return redirect()->route('admin.restaurants.show', $restaurant->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::find($id);

        // Remove image if exists
        if($restaurant->image) {
            Storage::delete($restaurant->image);
        }

        $restaurant->delete();
        return redirect()->route('admin.home')->with('deleted', $restaurant->name);
    }
}
