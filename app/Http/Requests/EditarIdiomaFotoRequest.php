<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditarIdiomaFotoRequest extends FormRequest
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
    protected $errorBag = 'EditarIdiomaFotoBag';
    
    public function rules(): array
    {
        return [
            'foto' => 'bail|required|image'
        ];
    }

    public function messages(): array
    {
        return [
            'foto.required' => 'La imágen es requerida',
            'foto.image' => 'El archivo seleccionado no es una imágen',
        ];
    }
}
