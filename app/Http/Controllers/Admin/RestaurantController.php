<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
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
        return view ('admin.restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRestaurantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRestaurantRequest $request)
    {   
        // Get validated data from form
        $request->validated();
        $data = $request->all();

        $newRestaurant = new Restaurant();

        // Restaurant slug
        $newRestaurant->slug = Str::slug($data['name']);

        // Save image in storage
        if(isset($data['image'])) {
            $path_img = Storage::put('uploads', $data['image']);
            
            $newRestaurant->image = $path_img;
        }

        // Fill database with non-guarded data
        $newRestaurant->user_id = 6;
        $newRestaurant->fill($data);
        $newRestaurant->save();

        return redirect()->route('admin.dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        return view('admin.restaurants.edit', compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRestaurantRequest  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {   
        // Get validated data from form
        $request->validated();
        $data = $request->all();

        // Edited restaurant slug
        $restaurant->slug = Str::slug($data['name']);
        
        // Edited image
        if (isset($data['image'])) {                                    //if there is an image in the form data
            if ($restaurant->image) {                                   //if there was an image in the database
                Storage::delete($restaurant->image);                    //delete image from storage
            }

            $path_img = Storage::put('uploads', $data['image']);        //Save new image in storage

            $restaurant->image = $path_img;                             //Save new image in database
        }

        $restaurant->update($data);

        return redirect()->route('admin.dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
}
