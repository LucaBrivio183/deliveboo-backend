<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|string|max:40',
            'vat_number' => 'required|string|size:11|unique:restaurants',
            'address' => 'required|string|max:50',
            'postal_code' => 'nullable|string|size:5',
            'city' => 'required|string|max:20',
            'business_times' => 'nullable|string|max:255',
            'phone_number' => 'required|string|max:15',
            'delivery_cost' => 'required|numeric|lt:100',
            'min_purchase' => 'required|numeric|lt:100',
            'image' => 'nullable|image|max:2048',
        ];
    }
}
