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
            'name' => 'required|string|max:60',
            'email' => 'required|string|email|max:50|unique:users',   
            'username' => 'required|string|max:30|unique:users',
            'ci' => 'required|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => "Se requiere nombre",
            'name.max' => "El nombre no puede exceder 60 caracteres",
            'email.required' => 'Se requiere email',
            'email.max' => 'El email no puede exceder 50 caracteres',
            'email.unique' => 'El email ya se encuentra registrado',
            'username.required' => "Se requiere el username",
            'username.max' => "El usernombre no puede exceder 30 caracteres",
            'unsername.unique' => "No se puede utilizar ese username",
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe ser mayor a 6 caracteres',
            'password.confirmed' => 'Las contraseñas no son iguales',
            'role' => 'Debe asignar un rol al usuario',
        ];
    }
}
