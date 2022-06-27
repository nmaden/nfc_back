<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfficeRequest extends FormRequest
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
            'city'=>  ['nullable','integer'],
            'area'=>  ['nullable','integer'],
            'wifi'=>  ['nullable','integer'],
            'tv'=>  ['nullable','integer'],
            'coffee_machine'=>  ['nullable','integer'],
            'price_from'=>  ['nullable','integer'],
            'price_to'=>  ['nullable','integer'],
        ];
    }
}
