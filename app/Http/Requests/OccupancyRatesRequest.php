<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OccupancyRatesRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'product_ids' => 'array',
            'room_ids' => 'array',
            'room_ids.*' => 'exists:rooms,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'product_ids.required' => 'The product ids field is required.',
            'product_ids.array' => 'The product ids field must be an array.',
            'room_ids.array' => 'The room ids field must be an array.',
            'room_ids.*.exists' => 'One or more of the selected rooms do not exist.',
        ];
    }
}
