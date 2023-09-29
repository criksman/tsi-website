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
            'enunciado' => 'required',
            'audio' => 'nullable|sometimes|max:100',
            'respuesta_corr' => 'required|max:100',
            'respuesta_inc1' => 'required|max:100',
            'respuesta_inc2' => 'required|max:100',
            'respuesta_inc3' => 'required|max:100',
        ];
    }
}
