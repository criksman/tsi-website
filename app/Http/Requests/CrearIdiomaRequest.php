<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearIdiomaRequest extends FormRequest
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
    protected $errorBag = 'CrearIdiomaBag';
    
     public function rules(): array
    {
        return [
            'nombre' => 'required|unique:idiomas|min:2|max:30',
            'foto' => 'required',
        ];
    }
}
