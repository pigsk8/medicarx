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
            'paciente' => 'required',
            'medico' => 'required',
            'estudio' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'paciente.required' => 'El paciente es obligatorio',
            'medico.required' => 'El medico es obligatorio',
            'estudio.required' => 'El tipo de estudio es obligatorio',
        ];
    }
}
