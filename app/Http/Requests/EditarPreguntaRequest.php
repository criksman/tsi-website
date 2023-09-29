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
        return [
            'enunciado' => 'nullable|sometimes',
            'audio' => 'nullable|sometimes|max:100',
            'respuesta_corr' => 'nullable|sometimes|max:100',
            'respuesta_inc1' => 'nullable|sometimes|max:100',
            'respuesta_inc2' => 'nullable|sometimes|max:100',
            'respuesta_inc3' => 'nullable|sometimes|max:100',
        ];
    }
}
