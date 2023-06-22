<?php

namespace App\Http\Requests;

use App\Http\Controllers\Admin\ProductController;
use App\Models\Restaurant;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(ProductController $request)
    {

        $userRestaurant = $request->getCurrentUserRestaurant();

        $categories = $request->getCurrentRestaurantCategories();

        // Get the current categories id
        $categories_id = [];

        foreach ($categories as $category) {
            $category_id = $category->id;
            if (!in_array($category_id, $categories_id)) {
                array_push($categories_id, $category_id);
            }
        }
        return [
            'name' => [
                'required',
                'string',
                'max:80',
                // The product must be unique in the current user's restaurant
                Rule::unique('products')->where(function (Builder $query) use ($userRestaurant) {
                    return $query->where('restaurant_id', $userRestaurant)->where('name', '!=', $this->product->name);
                })
            ],
            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'price' => 'required|numeric|min:1|lte:99',
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
