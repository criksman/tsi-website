<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditarPreguntaAudioRequest extends FormRequest
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
    protected $errorBag = 'EditarPreguntaAudioBag';
    
    public function rules(): array
    {
        return [
            'audio' => 'bail|required'
        ];
    }

    public function messages(): array
    {
        return [
            'audio.required' => 'El archivo de audio es requerido',
        ];
    }
}
