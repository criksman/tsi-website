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
            'idioma_id' => 'required|exists:idiomas,idioma_id',
            'dificultad_id' => 'required|exists:dificultades,dificultad_id',
        ];
    }
}
