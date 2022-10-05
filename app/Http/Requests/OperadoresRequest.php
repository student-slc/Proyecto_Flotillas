<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OperadoresRequest extends FormRequest
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
            "nombreoperador" => 'required',
            "fechanacimiento" => 'required',
            "nolicencia" => 'required',
            "tipolicencia" => 'required',
            "fechavencimientomedico" => 'required',
            "fechavencimientolicencia" => 'required',
            "unidad" => 'required',
            "licencia" => 'required',
            "curso" => 'required',
            "examenmedico" => 'required'
        ];
    }
    public function messages()
    {
        return [
            "nombreoperador.required" => 'El Nombre del Operador es Obligatorio',
            "fechanacimiento.required" => 'La Fecha de Nacimineto es Obligatoria',
            "nolicencia.required" => 'El No de Licencia es Obligatorio',
            "tipolicencia.required" => 'El Tipo de Licencia es Obligatorio',
            "fechavencimientomedico.required" => 'La Fecha de Vencimineto Medico es Obligatoria',
            "fechavencimientolicencia.required" => 'La Fecha de Vencimineto DE Licenia es Obligatoria',
            "licencia.required" => 'El Doc de la Licenia es Obligatoria',
            "curso.required" => 'El Doc del Curso es Obligatoria',
            "examenmedico.required" => 'El Doc del Examen Medico es Obligatoria',
        ];
    }
}
