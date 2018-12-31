<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'old_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
    public function messages()
    {
        return [
            'old_password.required' => "La contraseña actual es requerida",
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe ser mayor a 6 caracteres',
            'password.confirmed' => 'Las contraseñas no son iguales',
        ];
    }
}
