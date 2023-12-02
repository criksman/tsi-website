<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestablecerContrasenaRequest extends FormRequest
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
            'username'=> 'bail|required',
            'password' => 'bail|required|confirmed|min:2|max:255',
            'password_confirmation' => 'bail|required|min:2|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'El nombre de usuario es requerido',
            'password.required' => 'La contraseña es requerida',
            'password.confirmed' => 'Las contraseña no coinciden',
            'password.min' => 'La contraseña debe ser de mínimo 2 caracteres',
            'password.max' => 'La contraseña debe ser de mínimo 255 caracteres',
            'password_confirmation.required' => 'La contraseña es requerida',
            'password_confirmation.min' => 'La contraseña debe ser de mínimo 2 caracteres',
            'password_confirmation.max' => 'La contraseña debe ser de mínimo 255 caracteres',
        ];
    }
}
