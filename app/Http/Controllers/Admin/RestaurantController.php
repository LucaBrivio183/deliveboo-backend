<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Models\Typology;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Restaurant $restaurant)
    {
        $currentUserId = auth()->user()->id;
        // Find the current user's restaurant ID
        $restaurants = Restaurant::where('user_id', $currentUserId)->get();

        if(auth()->user()->restaurant) {

            return view('admin.restaurants.index', compact('restaurants'));
        } else {
            return redirect()->route('welcome');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typologies = Typology::orderBy('name')->get();
        $currentUser = auth()->user();

        return view('admin.restaurants.create', compact('typologies', 'currentUser'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRestaurantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRestaurantRequest $request)
    {
        $currentUserId = auth()->user()->id;
        // Get validated data from form
        $request->validated();
        $data = $request->all();

        $newRestaurant = new Restaurant();

        // Restaurant slug
        $newRestaurant->slug = Str::slug($data['name']);

        // If delivery cost or minimum purchase are specified in the form, save the specified input. Otherwise, default to 0.
        if (isset($data['delivery_cost'])) {
            $newRestaurant->delivery_cost = $data['delivery_cost'];
        }
        if (isset($data['min_purchase'])) {
            $newRestaurant->min_purchase = $data['min_purchase'];
        }

        // Save image in storage
        if (isset($data['image'])) {
            $path_img = Storage::put('uploads', $data['image']);

            $newRestaurant->image = $path_img;
        }

        // Fill database with non-guarded data
        $newRestaurant->user_id = $currentUserId;
        $newRestaurant->fill($data);
        $newRestaurant->save();

        if (isset($data['typologies'])) {
            $newRestaurant->typologies()->sync($data['typologies']);
        }

        return redirect()->route('admin.dashboard')->with('message', "Ristorante $newRestaurant->name creato con successo");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        $currentUserId = auth()->user()->id;
        // Stop users from viewing other users' restaurants 
        if ($currentUserId === $restaurant->user_id) {

            return view('admin.restaurants.show', compact('restaurant'));
        } else {
            abort(404);     //access denied
        };
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $currentUserId = auth()->user()->id;

        // Stop users from editing other users' restaurants 
        if ($currentUserId === $restaurant->user_id) {

            $typologies = Typology::orderBy('name')->get();

            return view('admin.restaurants.edit', compact('restaurant', 'typologies'));
        } else {
            abort(404);     //access denied
        }
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

        // If delivery cost or minimum purchase are specified in the form, save the specified input. Otherwise, default to 0.
        if (isset($data['delivery_cost'])) {
            $restaurant->delivery_cost = $data['delivery_cost'];
        } else {
            $restaurant->delivery_cost = 0;
        }
        if (isset($data['min_purchase'])) {
            $restaurant->min_purchase = $data['min_purchase'];
        } else {
            $restaurant->min_purchase = 0;
        }

        if (isset($data['typologies'])) {
            $restaurant->typologies()->sync($data['typologies']);
        }

        // Edited image
        if (isset($data['image'])) {                                    //if there is an image in the form data
            if ($restaurant->image) {                                   //if there was an image in the database
                Storage::delete($restaurant->image);                    //delete image from storage
            }

            $path_img = Storage::put('uploads', $data['image']);        //Save new image in storage

            $restaurant->image = $path_img;                             //Save new image in database
        }

        $restaurant->update($data);

        return redirect()->route('admin.dashboard')->with('message', "Ristorante $restaurant->name modificato con successo");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $old_name = $restaurant->name;

        $restaurant->delete();
        return redirect()->route('welcome')->with('message', "Ristorante $old_name eliminato con successo");
    }
}
