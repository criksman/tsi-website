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
            'nombre' => 'required|unique:tematicas|min:2|max:30',
            'dificultad_id' => 'required|exists:dificultades,dificultad_id',
            'seccion_id' => 'required|exists:secciones,seccion_id',
            'descripcion' => 'required',
            'foto' => 'required',
        ];
    }
}