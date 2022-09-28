<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FumigacionesRequest extends FormRequest
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
            "id_cliente" => 'required',
            "id_fumigador" => 'required',
            "fechaprogramada" => 'required',
            "fechaultimafumigacion" => 'required',
            "lugardelservicio" => 'required',
            "status" => 'required',
            "numerodevisitas" => 'required',
            "costo" => 'required',
            "satisfaccionservicio" => 'required',
        ];
    }
    public function messages()
    {
        return [
            "id_cliente.required" => 'El Cliente es obligatorio',
            "id_fumigador.required" => 'El Fumigador es obligatorio',
            "fechaprogramada.required" => 'La Fecha Programada es obligatoria',
            "fechaultimafumigacion.required" => 'La fecha de la ultima Fumigacion es obligatoria',
            "lugardelservicio.required" => 'El lugar es obligatorioa',
            "status.required" => 'El Status es obligatorio',
            "numerodevisitas.required" => 'El Numero de Visitas es obligatorio',
            "costo.required" => 'El Costo es obligatorio',
            "satisfaccionservicio.required" => 'La Satisfaccion es obligatoria',
        ];
    }
}
