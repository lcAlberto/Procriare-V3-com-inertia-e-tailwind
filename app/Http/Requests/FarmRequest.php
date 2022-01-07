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
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:4', 'max:100', 'unique:farms'],
            'owner' => ['required', 'string'],
            'postal_code' => ['required', 'string', 'min:8', 'max:9'],
            'city_id' => ['required', 'string'],
            'state_id' => ['required', 'string',],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nome é obrigatório',
            'name.min:4' => 'Nome precisa ter no mínimo 4 letras',
            'name.max:100' => 'Nome precisa ter no máximo 100 letras',
            'name.unique:farms' => 'Parece que já existe uma fazenda com este nome',
            'owner.required' => 'Proprietário é obrigatório',
            'city_id.required' => 'Cidade é obrigatório',
            'state_id.required' => 'Estado é obrigatório',
        ];
    }
}
