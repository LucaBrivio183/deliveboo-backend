<?php

namespace App\Http\Requests;

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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
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
        ];
    }
}
