<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
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
            'usuario_id' => 'required',
            'password' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'usuario_id.required' => 'El Nombre de usuario es requerido.',
            'password.required' => 'La contraseña es requerida',
        ];
    }
}
