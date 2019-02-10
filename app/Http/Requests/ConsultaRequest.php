<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultaRequest extends FormRequest
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
            'img-rad' => 'required|mimes:jpeg,png|max:1024',
            'paciente' => 'required',
            'medico' => 'required',
            'estudio' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'img-rad.required' => 'La imagen radiografica es obligatoria',
            'img-rad.mimes' => 'El tipo de archivo aceptado es jpeg o png',
            'img-rad.max' => 'El tamaño de la imagen supera 1MB',
            'paciente.required' => 'El paciente es obligatorio',
            'medico.required' => 'El medico es obligatorio',
            'estudio.required' => 'El tipo de estudio es obligatorio',
        ];
    }
}
