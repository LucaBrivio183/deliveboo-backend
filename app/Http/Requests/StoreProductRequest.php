<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the current user's restaurant.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCurrentUserRestaurant()
    {
        // Find the current user ID
        $currentUserId = auth()->user()->id;
        // Find the current user's restaurant ID
        $userRestaurantId = Restaurant::where('user_id', $currentUserId)->first()->id;

        return $userRestaurantId;
    }

    /**
     * Get the current restaurant's products.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCurrentRestaurantProducts()
    {
        // Find the current restaurant's products
        $products = Product::where('restaurant_id', $this->getCurrentUserRestaurant())->get();

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
            if(!in_array($category, $productCategories)) {
                array_push($productCategories, $category);
            }
        }

        // Query to select all the categories contained into the given array
        $categories = Category::whereIn('id', $productCategories)->get();

        return $categories;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $categories = $this->getCurrentRestaurantCategories();

        // Get the current categories id
        $categories_id = [];

        foreach ($categories as $category) {
            $category_id = $category->id;
            if(!in_array($category_id, $categories_id)) {
                array_push($categories_id, $category_id);
            }
        }
        
        return [
            'name' => [
                'required',
                'string',
                'max:80',
                // The product must be unique in the current user's restaurant
                Rule::unique('products')->where(function (Builder $query) {
                    return $query->where('restaurant_id', $this->getCurrentUserRestaurant());
                })
            ],
            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'price' => 'required|numeric|min:1|lte:20',
            'discount' => 'required|numeric|min:0|lte:0.99',
            'is_visible' => 'boolean',
            'category_id' => [
                'required',
                // The category_id must be part of the current restaurant's categories
                Rule::in($categories_id)
            ]
        ];
    }
}
