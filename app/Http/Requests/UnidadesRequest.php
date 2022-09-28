<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnidadesRequest extends FormRequest
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
            'serieunidad' => 'required',
            'marca' => 'required',
            'submarca' => 'required',
            'añounidad' => 'required',
            'tipounidad' => 'required',
            'razonsocialunidad' => 'required',
            'placas' => 'required',
            'status' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'serieunidad.required' => "El No de Serie es obligatorio",
            'marca.required' => "La Marca es obligatoria",
            'submarca.required' => "La Sub Marca es obligatoria",
            'añounidad.required' => "El Año de Unidad es obligatorio",
            'tipounidad.required' => "El Tipo de Unidad obligatorio",
            'razonsocialunidad.required' => "La Razon Social de Unidad es obligatoria",
            'placas.required' => "Las Placas son obligatorias",
            'status.required' => "El Status es obligatorio",
        ];
    }
}
