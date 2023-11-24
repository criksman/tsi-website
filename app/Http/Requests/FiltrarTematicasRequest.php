<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FiltrarTematicasRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'idioma_id' => 'bail|required|exists:idiomas,idioma_id',
            'dificultad_id' => 'bail|required|exists:dificultades,dificultad_id',
        ];
    }

    public function messages(): array
    {
        return [
            'idioma_id.required' => 'Idioma no seleccionado',
            'idioma_id.exists' => 'El idioma seleccionado no existe',
            'dificultad_id.required' => 'Dificultad no seleccionada',
            'dificultad_id.exists' => 'La dificultad seleccionada no existe',
        ];
    }
}
