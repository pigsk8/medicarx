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
            'img-rad' => 'required|mimes:jpeg,bmp,png|size:20',
            'paciente' => 'required',
            'medico' => 'required',
            'estudio' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'img-rad.required' => 'La imagen radiografica es obligatoria',
            'img-rad.mimes' => 'El tipo de archivo aceptado es jpeg,bmp,png',
            'img-rad.size' => 'El tamaño de la iamgen supera los 2MB',
            'paciente.required' => 'El paciente es obligatorio',
            'medico.required' => 'El medico es obligatorio',
            'estudio.required' => 'El tipo de estudio es obligatorio',
        ];
    }
}
