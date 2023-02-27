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
            'nombrecompletoc' => 'required',
            'telefonoc' => 'required',
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
            'regimen_fiscal' => 'required',
            'sfdi' => 'required',
            'servicio_seguro' => 'required',
            'servicio_ambiental' => 'required',
            'servicio_fisica' => 'required',
            'servicio_mantenimiento' => 'required',
            'servicio_fumigacion' => 'required',
            'servicio_omedico' => 'required',
            'servicio_olicencia' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'nombrecompleto.required' => "El Nombre es obligatorio",
            'razonsocial.required' => "La Razon Social es obligatoria",
            'telefono.required' => "La Razon Social es obligatoria",
            'nombrecompletoc.required' => 'El Nombre del contacto es obligatorio',
            'telefonoc.required' => 'El Telefono del contacto es obligatorio',
            'direccionfisica.required' => "La Direccion Fisica es obligatoria",
            'correo.required' => "La Razon Social es obligatoria",
            'statuspago.required' => "El Status es obligatorio",
            'colonia.required' => "La Colonia es obligatoria",
            'ciudad.required' => "La Ciudad es obligatoria",
            'municipio.required' => "El Municipio es obligatorio",
            'estado.required' => "El Estado es obligatorio",
            'codigopostal.required' => "El Codigo Postal es obligatorio",
            'rfc.required' => "El RFC es obligatorio",
            'numero.required' => "El Numero es obligatorio",
            'observaciones.required' => "Las Observaciones son obligatorias",
            'regimen_fiscal.required' => "El Regimen Fiscal es obligatorio",
            'sfdi.required' => "El SFDI es obligatorio",
            'servicio_seguro.required' => 'Es Obligatorio Seleccionar almenos una Opcion de Servicio',
            'servicio_ambiental.required' => 'Es Obligatorio Seleccionar almenos una Opcion de Servicio',
            'servicio_fisica.required' => 'Es Obligatorio Seleccionar almenos una Opcion de Servicio',
            'servicio_mantenimiento.required' => 'Es Obligatorio Seleccionar almenos una Opcion de Servicio',
            'servicio_fumigacion.required' => 'Es Obligatorio Seleccionar almenos una Opcion de Servicio',
            'servicio_omedico.required' => 'Es Obligatorio Seleccionar almenos una Opcion de Servicio',
            'servicio_olicencia.required' => 'Es Obligatorio Seleccionar almenos una Opcion de Servicio',
        ];
    }
}
