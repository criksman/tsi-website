<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsuarioEditarCredencialesRequest extends FormRequest
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

    protected $errorBag = 'EditarUsuarioCredencialesBag';

    public function rules(): array
    {
        return [
            'username' => 'nullable|bail|sometimes|unique:users|min:2|max:30',
            'email' => 'nullable|bail|sometimes|email:rfc|unique:users',
            'password' => 'required|current_password', 
        ];
    }

    public function messages(): array
    {
        return [
            'username.unique' => 'El nombre de usuario ya esta en uso',
            'username.min' => 'El nombre de usuario debe tener mínimo 2 caracteres',
            'username.max' => 'El nombre de usuario debe tener máximo 30 caracteres',
            'email.rfc' => 'El e-mail no esta en el formato correcto',
            'email.unique' => 'El e-mail ya esta en uso',
            'password.confirmed' => 'La contraseña no coincide'
        ];
    }
}
