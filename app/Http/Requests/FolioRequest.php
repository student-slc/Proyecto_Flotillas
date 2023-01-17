<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FolioRequest extends FormRequest
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
            'nombre' => 'required',
            'fecha_update' => 'required',
            'folio' => 'required',
            'rango' => 'required',
            'contador' => 'required',
            'tipo' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'nombre' => 'El Nombre es obligatorio',
            'fecha_update' => 'La Fecha es obligatoria',
            'folio' => 'El Folio es Obligatorio',
            'rango' => 'El Rango es Obligatorio',
            'contador' => 'El Contador es obligatorio',
            'tipo' => 'El Tipo de Folio es obligatorio',
        ];
    }
}
