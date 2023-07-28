<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfficeSearchRequest extends FormRequest
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
            'services' => ['required'],
            'city'=>  ['nullable','integer','exists:App\Models\City,id'],
            'price_from'=>  ['nullable','integer'],
            'price_to'=>  ['nullable','integer'],
        ];
    }
}
