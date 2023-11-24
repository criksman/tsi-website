<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearTematicaRequest extends FormRequest
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
    protected $errorBag = 'CrearTematicaBag';
    
    public function rules(): array
    {
        return [
            'nombre' => 'bail|required|unique:tematicas|min:2|max:30',
            'dificultad_id' => 'bail|required|exists:dificultades,dificultad_id',
            'seccion_id' => 'bail|required|exists:secciones,seccion_id',
            'descripcion' => 'bail|required',
            'foto' => 'bail|required',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es requerido',
            'nombre.unique'=> 'El nombre debe ser único',
            'nombre.min' => 'El nombre debe tener como mínimo 2 caracteres',
            'nombre.max' => 'El nombre debe tener como máximo 30 caracteres',
            'dificultad_id.required' => 'La dificultad es requerida',
            'dificultad_id.exists' => 'La dificultad seleccionada no existe',
            'seccion_id.required' => 'La sección seleccionada es requerida',
            'seccion_id.exists' => 'La sección seleccionada no existe',
            'descripcion.required' => 'La descripción es requerida',
            'foto.required' => 'La imágen es requerida',
        ];
    }
}
