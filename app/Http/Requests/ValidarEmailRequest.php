<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarEmailRequest extends FormRequest
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
            'email' => 'bail|required|min:2|max:255|exists:users'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'El e-mail es requerido',
            'email.min' => 'El e-mail debe tener como mínimo 2 caracteres',
            'email.max' => 'El e-mail debe tener como máximo 255 caracteres',
            'email.exists' => 'El email ingresado no existe',
        ];
    }
}
