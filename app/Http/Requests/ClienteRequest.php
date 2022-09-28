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
            'direccionfisica' => 'required',
            'statuspago' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'nombrecompleto.required'=>"El Nombre es obligatorio",
            'razonsocial.required'=>"La Razon Social es obligatoria",
            'direccionfisica.required'=>"La Direccion Fisica es obligatoria",
            'statuspago.required'=>"El Status es obligatorio",
        ];

    }
}
