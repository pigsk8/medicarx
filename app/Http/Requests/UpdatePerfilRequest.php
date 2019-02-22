<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePerfilRequest extends FormRequest
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
            'name' => 'required|string|max:60',
            'role' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => "Se requiere nombre",
            'name.max' => "El nombre no puede exceder 60 caracteres",
            'role' => 'Debe asignar un rol al usuario',
        ];
    }
}
