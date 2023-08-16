<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditarTematicaDetallesRequest extends FormRequest
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
    protected $errorBag = 'EditarTematicaDetallesBag';

    public function rules(): array
    {
        return [
            'nombre' => 'nullable|bail|sometimes|min:2|max:30',
            'seccion_id' => 'nullable|bail|sometimes|exists:secciones,seccion_id',
            'descripcion' => 'nullable|bail|sometimes|min:2|max:200'
        ];
    }
}
