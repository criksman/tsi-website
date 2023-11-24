<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearEnlacesRequest extends FormRequest
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
    protected $errorBag = 'CrearEnlacesBag';
    public function rules(): array
    {
        return [
            'link' => 'bail|required',
            'descripcion' => 'bail|required|min:2|max:300'
        ];
    }

    public function messages(): array
    {
        return [
            'link.required' => 'El link es requerido',
            'descripcion.required' => 'La descripción es requerida',
            'descripcion.min' => 'La descripción debe tener como mínimo 2 caracteres',
            'descripcion.max' => 'La descripción debe tener como máximo 300 caracteres',
        ];
    }
}
