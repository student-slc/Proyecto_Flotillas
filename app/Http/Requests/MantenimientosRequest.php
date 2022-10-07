<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MantenimientosRequest extends FormRequest
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
            "id_unidad" => "required",
            "kmfinales" => "required",
            "fecha" => "required",
            "frecuencia" => "required",
            "sigservicio" => "required",
            "kmfaltantes" => "required",
            "tipomantenimiento" => "required",
        ];
    }
    public function messages()
    {
        return [
            "id_unidad.required" => 'La Unidad es Obligatoria',
            "kmfinales.required" => 'Los Km Finales son Obligatorios',
            "fecha.required" => 'La Fecha es Obligatoria',
            "frecuencia.required" => 'La Frecuencia es Obligatoria',
            "sigservicio.required" => 'El Siguiente Servicio es Obligatorio',
            "kmfaltantes.required" => 'Los Km Faltantes son Obligatorios',
            "tipomantenimiento.required" => 'El Tipo de Mantenimiento es Obligatorio'
        ];
    }
}
