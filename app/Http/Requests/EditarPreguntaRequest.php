<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditarPreguntaRequest extends FormRequest
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
    
    protected $errorBag = 'EditarPreguntaBag';

    public function rules(): array
    {
        //nullable creo que es innecesario
        return [
            'enunciado' => 'bail|nullable|sometimes|max:255',
            'audio' => 'bail|nullable|sometimes|max:100',
            'respuesta_corr' => 'bail|nullable|sometimes|max:100',
            'respuesta_inc1' => 'bail|nullable|sometimes|max:100',
            'respuesta_inc2' => 'bail|nullable|sometimes|max:100',
            'respuesta_inc3' => 'bail|nullable|sometimes|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'enunciado.max'=> 'El enunciado debe tener como máximo 255 caracteres',
            'audio.max'=> 'El audio debe pesar menos de 100 KB',
            'respuesta_corr.max'=> 'La respuesta debe tener como máximo 100 caracteres',
            'respuesta_inc1.max'=> 'La respuesta debe tener como máximo 100 caracteres',
            'respuesta_inc2.max'=> 'La respuesta debe tener como máximo 100 caracteres',
            'respuesta_inc3.max'=> 'La respuesta debe tener como máximo 100 caracteres',
        ];
    }
}
