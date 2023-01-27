<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerificacionesRequest extends FormRequest
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
            'id_unidad' => 'required',
            'fechavencimiento' => 'required',
            'tipoverificacion' => 'required',
            'subtipoverificacion' => 'required',
            'ultimaverificacion' => 'required',
            'estado' => 'required',
            'noverificacion' =>'required'
        ];
    }
    public function messages()
    {
        return [
            'id_unidad.required'=>"La Unidad es obligatoria",
            'fechavencimiento.required'=>"La Fecha de Vencimiento es obligatoria",
            'tipoverificacion.required'=>"El Tipo de Verificaion es obligatoria",
            'subtipoverificacion.required'=>"El Subtipo de Verificacion es obligatoria",
            'ultimaverificacion.required'=>"La Ultima Verificacion es obligatoria",
            'estado.required'=>"El Estado es obligatorio",
            'noverificacion.required'=>"El Numero de Verificacion es obligatorio",
        ];

    }
}
