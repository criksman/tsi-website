<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearPreguntaRequest extends FormRequest
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

    protected $errorBag = 'CrearPreguntaBag';
    
    public function rules(): array
    {
        return [
            'enunciado' => 'bail|required',
            'audio' => 'bail|nullable|sometimes|mimes:mp3',
            'respuesta_corr' => 'bail|required|max:100',
            'respuesta_inc1' => 'bail|required|max:100',
            'respuesta_inc2' => 'bail|required|max:100',
            'respuesta_inc3' => 'bail|required|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'audio.mimes' => 'El archivo de audio debe ser de tipo: mp3',
            'enunciado.required' => 'El enunciado es requerido',
            'respuesta_corr.required' => 'La respuesta es requerida',
            'respuesta_corr.max' => 'La respuesta debe tener como máximo 100 caracteres',
            'respuesta_inc1.required' => 'La respuesta es requerida',
            'respuesta_inc1.max' => 'La respuesta debe tener como máximo 100 caracteres',
            'respuesta_inc2.required' => 'La respuesta es requerida',
            'respuesta_inc2.max' => 'La respuesta debe tener como máximo 100 caracteres',
            'respuesta_inc3.required' => 'La respuesta es requerida',
            'respuesta_inc3.max' => 'La respuesta debe tener como máximo 100 caracteres',
        ];
    }
}
