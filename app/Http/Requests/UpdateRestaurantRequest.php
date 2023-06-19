<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRestaurantRequest extends FormRequest
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
            'vat_number' => [
                'required',
                'integer',
                'digits:11',
                Rule::unique('restaurants')->ignore($this->restaurant),
            ],
            'address' => 'required|string|max:50',
            'postal_code' => 'nullable|numeric|digits:5',
            'business_times' => 'nullable|string|max:255',
            'phone_number' => 'required|string|max:15',
            'delivery_cost' => 'min:0|max:99.99',
            'min_purchase' => 'min:0|max:99.99',
            'image' => 'nullable|image|max:2048',
            'typologies' => 'required|array|min:1|max:3',
        ];
    }
   
    /**
     * personalized error messages
     *
     * @return void
     */
    public function messages() {

        return [
            'required' => 'Questo campo è obbligatorio',
            'vat_number.integer' => 'La partita iva deve essere numerica',
            'vat_number.digits' => 'La partita iva deve avere 11 caratteri',
            'vat_number.unique' => 'Questa partita iva è già esistente',
            'postal_code.numeric' => 'Il codice postale deve essere un numero',
            'postal_code.digits' => 'Il codice postale deve avere 5 caratteri',
            'typologies.required' => 'Seleziona almeno una tipologia',
            'typologies.max' => 'Seleziona un massimo di 3 tipologie',
            'image.image' => 'Il file selezionato deve essere un\'immagine',
            'image.max' => 'Il file selezionato può avere una grandezza massima di 2 mb',
        ];
    }
}
