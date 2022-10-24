<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SegurosRequest extends FormRequest
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
            'nopoliza' => 'required',
            'id_unidad' => 'required',
            'fechavencimiento' => 'required',
            'fechainicio' => 'required',
            'tiposeguro' => 'required',
            'caratulaseguro' => 'required',
            'provedor' => 'required',
            'precio' => 'required',
            'impuestos' => 'required',
            'costototal' => 'required',
            'estado' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'nopoliza.required' => "El No de Poliza es obligatorio",
            'id_unidad.required' => "La Unidad es obligatoria",
            'fechavencimiento.required' => "La Fecha de Vencimiento es obligatoria",
            'fechainicio.required' => "La Fecha de Inicio es obligatoria",
            'tiposeguro.required' => "El Tipo de Seguro es obligatorio",
            'caratulaseguro.required' => "La Caratula es obligatoria",
            'provedor.required' => "El Proveedor obligatorias",
            'precio.required' => "El Precio obligatorio",
            'impuestos.required' => "Los Impuestos son obligatorios",
            'costototal.required' => "El Costo Total es obligatorio",
            'estado.required' => "El Estado es obligatorio",
        ];
    }
}
