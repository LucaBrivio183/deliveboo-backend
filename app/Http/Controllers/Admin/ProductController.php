<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Get the current user's restaurant.
     *
     * @return \Illuminate\Http\Response
     */
    public static function getCurrentUserRestaurant()
    {
        // Find the current user ID
        $currentUserId = auth()->user()->id;
        // Find the current user's restaurant ID
        $userRestaurant = Restaurant::where('user_id', $currentUserId)->first();

        if ($userRestaurant) {
            return $userRestaurant->id;
        }
    }

    /**
     * Get the current restaurant's products.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCurrentRestaurantProducts()
    {
        // Find the current restaurant's products
        $products = Product::where('restaurant_id', $this->getCurrentUserRestaurant())->orderBy('name', 'asc')->get();

        return $products;
    }

    /**
     * Get the current restaurant's categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCurrentRestaurantCategories()
    {
        $products = $this->getCurrentRestaurantProducts();

        $productCategories = [];

        // Find all the products' categories
        foreach ($products as $product) {
            $category = $product->category_id;
            if (!in_array($category, $productCategories)) {
                array_push($productCategories, $category);
            }
        }

        // Query to select all the categories contained into the given array
        $categories = Category::whereIn('id', $productCategories)->get();

        return $categories;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Find the current user ID
        $currentUser = auth()->user();

        $products = $this->getCurrentRestaurantProducts();

        $categories = $this->getCurrentRestaurantCategories();

        if ($currentUser->restaurant) {
            return view('admin.products.index', compact('products', 'categories'));
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->getCurrentRestaurantCategories();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        $newProduct = new Product();
        $newProduct->fill($data);
        $newProduct->slug = Str::slug($data['name']);
        $newProduct->restaurant_id = $this->getCurrentUserRestaurant();

        if (isset($data['is_visible'])) {
            $newProduct->is_visible = 1;
        } else {
            $newProduct->is_visible = 0;
        };

        // if(isset($data['image'])) {
        //     $newProduct->image = Storage::put('uploads', $data['image']);
        // }

        $newProduct->save();

        return redirect()->route('admin.dashboard')->with('message', "Prodotto $newProduct->name creato con successo");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product = Product::where('restaurant_id', $this->getCurrentUserRestaurant())->where('name', $product->name)->first();

        if ($product) {
            return view('admin.products.show', compact('product'));
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

        //get categories from current user
        $categories = $this->getCurrentRestaurantCategories();

        $product = Product::where('restaurant_id', $this->getCurrentUserRestaurant())->where('name', $product->name)->first();

        if ($product) {
            return view('admin.products.edit', compact('product', 'categories'));
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product = Product::where('restaurant_id', $this->getCurrentUserRestaurant())->where('name', $product->name)->first();

        $data = $request->validated();

        $product->slug = Str::slug($data['name']);

        // In order to set is_visible property, we need to rewrite $data
        if (isset($data['is_visible'])) {
            $data['is_visible'] = 1;
        } else {
            $data['is_visible'] = 0;
        };

        // if (isset($data['image'])) {
        //     if ($product->image) {
        //         Storage::delete($product->image);
        //     }

        //     $product->image = Storage::put('uploads', $data['image']);
        // } else if (empty($data['image'])) {
        //     if ($product->image) {
        //         Storage::delete($product->image);
        //         $product->image = null;
        //     }
        // }


        $product->update($data);

        return to_route('admin.dashboard')->with('message', "Prodotto  $product->name modificato con successo");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $old_name = $product->name; // save name to recall in message

        Product::where('restaurant_id', $this->getCurrentUserRestaurant())->where('name', $old_name)->delete();

        return redirect()->route('admin.products.index')->with('message', "Prodotto $old_name eliminato con successo");
    }
}
