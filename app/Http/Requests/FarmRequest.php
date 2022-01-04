<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FarmRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:4', 'max:100', 'unique:farms'],
            'owner' => ['required', 'string', 'min:4', 'max:100'],
            'postal_code' => ['required', 'string', 'min:9', 'max:9'],
            'city_id' => ['required', 'string', 'min:1', 'max:9'],
            'state' => ['required', 'string', 'min:1', 'max:9'],
        ];
    }
}
