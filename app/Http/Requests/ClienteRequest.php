<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
            'razonsocial' => 'required',
            'telefono' => 'required',
            'direccionfisica' => 'required',
            'correo' => 'required',
            'statuspago' => 'required',
            'colonia' => 'required',
            'ciudad' => 'required',
            'municipio' => 'required',
            'estado' => 'required',
            'codigopostal' => 'required',
            'rfc' => 'required',
            'numero' => 'required',
            'observaciones' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'nombrecompleto.required'=>"El Nombre es obligatorio",
            'razonsocial.required'=>"La Razon Social es obligatoria",
            'telefono.required'=>"La Razon Social es obligatoria",
            'direccionfisica.required'=>"La Direccion Fisica es obligatoria",
            'correo.required'=>"La Razon Social es obligatoria",
            'statuspago.required'=>"El Status es obligatorio",
            'colonia.required'=>"La Colonia es obligatoria",
            'ciudad.required'=>"La Ciudad es obligatoria",
            'municipio.required'=>"El Municipio es obligatorio",
            'estado.required'=>"El Estado es obligatorio",
            'codigopostal.required'=>"El Codigo Postal es obligatorio",
            'rfc.required'=>"El RFC es obligatorio",
            'numero.required'=>"El Numero es obligatorio",
            'observaciones.required'=>"Las Observaciones son obligatorias",

        ];

    }
}
