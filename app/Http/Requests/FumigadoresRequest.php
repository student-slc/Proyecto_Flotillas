<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FumigadoresRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nombrecompleto' => 'required',
            'fechanacimiento' => 'required',
            'certificacion' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'nombrecompleto.required' => 'El Nombre es obligatorio',
            'fechanacimiento.required' => 'La Fecha de Nacimiento es obligatoria',
            'certificacion.required' => 'El Certificado es obligatorio'
        ];
    }
}
