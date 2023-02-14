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
            "id_fumigador" => 'required',
            "fechaprogramada" => 'required',
            "fechaultimafumigacion" => 'required',
            "lugardelservicio" => 'required',
            "status" => 'required',
            "numerodevisitas" => 'required',
            "costo" => 'required',
            "numerofumigacion" => 'required',
            "unidad" => 'required',
            "producto" => 'required',
            "insectosvoladores" => 'required',
            "pulgas" => 'required',
            "aracnidos" => 'required',
            "roedores" => 'required',
            "insectosrastreros" => 'required',
            "mosca" => 'required',
            "hormigas" => 'required',
            "alacranes" => 'required',
            "cucaracha" => 'required',
            "chinches" => 'required',
            "termitas" => 'required',
            "carcamo" => 'required',
            "tipo" => 'required',
            "observaciones" => 'required',
        ];
    }
    public function messages()
    {
        return [
            "id_fumigador.required" => 'El Fumigador es obligatorio',
            "fechaprogramada.required" => 'La Fecha Programada es obligatoria',
            "fechaultimafumigacion.required" => 'La fecha de la ultima Fumigacion es obligatoria',
            "lugardelservicio.required" => 'El lugar es obligatorioa',
            "status.required" => 'El Status es obligatorio',
            "numerodevisitas.required" => 'El Numero de Visitas es obligatorio',
            "costo.required" => 'El Costo es obligatorio',
            "numerofumigacion.required" => 'El Número de Fumigación es obligatorio',
            "unidad.required" => 'La Unidad es obligatoria',
            "producto.required" => 'El Producto es Obligatorio',
            "insectosvoladores.required" => 'El INSECTO es Obligatorio',
            "pulgas.required" => 'El INSECTO es Obligatorio',
            "aracnidos.required" => 'El INSECTO es Obligatorio',
            "roedores.required" => 'El INSECTO es Obligatorio',
            "insectosrastreros.required" => 'El INSECTO es Obligatorio',
            "mosca.required" => 'El INSECTO es Obligatorio',
            "hormigas.required" => 'El INSECTO es Obligatorio',
            "alacranes.required" => 'El INSECTO es Obligatorio',
            "cucaracha.required" => 'El INSECTO es Obligatorio',
            "chinches.required" => 'El INSECTO es Obligatorio',
            "termitas.required" => 'El INSECTO es Obligatorio',
            "carcamo.required" => 'El INSECTO es Obligatorio',
            "tipo.required" => 'El Tipo es Obligatorio',
            "observaciones.required" => 'Las Observaciones son Obligatorias',
        ];
    }
}
