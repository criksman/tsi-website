<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditarTematicaDetallesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    protected $errorBag = 'EditarTematicaDetallesBag';

    public function rules(): array
    {
        //nullable es innecesario, evaluar maneras de hacerlo mejor.
        return [
            'nombre' => 'bail|nullable|sometimes|min:2|max:30',
            'seccion_id' => 'bail|nullable|sometimes|exists:secciones,seccion_id',
            'descripcion' => 'bail|nullable|sometimes|min:2|max:200'
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.min'=> 'El nombre debe tener como mínimo 2 caracteres',
            'nombre.max'=> 'El nombre debe tener como máximo 30 caracteres',
            'seccion_id.exists'=> 'La sección seleccionada no existe',
            'descripcion.min' => 'La sección debe tener como mínimo 2 caracteres',
            'descripcion.max' => 'La sección debe tener como máximo 200 caracteres',
        ];
    }
}
