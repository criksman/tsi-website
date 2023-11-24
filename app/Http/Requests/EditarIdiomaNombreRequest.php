<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditarIdiomaNombreRequest extends FormRequest
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

    protected $errorBag = 'EditarIdiomaNombreBag';

    public function rules(): array
    {
        return [
            'nombre' => 'bail|required|unique:idiomas,nombre|min:2|max:30'
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es requerido',
            'nombre.unique' => 'El nombre debe ser único',
            'nombre.min'=> 'El nombre debe tener como mínimo 2 caracteres',
            'nombre.max'=> 'El nombre debe tener como máxmimo 30 caracteres',
        ];
    }
}
