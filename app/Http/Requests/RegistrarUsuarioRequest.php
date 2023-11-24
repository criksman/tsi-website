<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrarUsuarioRequest extends FormRequest
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
            'username' => 'bail|required|min:2|max:30',
            'email' => 'bail|required|min:2|max:255|email:rfc|unique:users',
            'password' => 'bail|required|min:2|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'El nombre de usuario es requerido',
            'username.min' => 'El nombre de usuario debe tener como mínimo 2 caracteres',
            'username.max' => 'El nombre de usuario debe tener como máximo 30 caracteres',
            'email.required' => 'La dirección e-mail es requerida',
            'email.min' => 'La dirección e-mail debe tener como mínimo 2 caracteres',
            'email.max' => 'La dirección e-mail debe tener como máxmimo 255 caracteres',
            'email.email' => 'La dirección e-mail no tiene el formato correcto',
            'email.unique' => 'La dirección e-mail ya se encuentra en uso',
            'password.required'=> 'La contraseña es requerida',
            'password.min' => 'La contraseña debe tener como mínimo 2 caracteres',
            'password.max' => 'La contraseña debe tener como máximo 255 caracteres',
        ];
    }
}
