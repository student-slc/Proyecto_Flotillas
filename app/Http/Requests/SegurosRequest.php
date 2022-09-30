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
        ];
    }
}
