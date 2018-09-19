<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAdminRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'ci' => 'required|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => "Se requiere nombre",
            'name.max' => "El nombre no puede exceder 255 caracteres",
            'password.required' => 'pass requerido',
            'password.confirmed' => 'Los pass no son iguales',
        ];
    }
}
