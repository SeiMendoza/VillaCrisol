<?php

namespace App\Http\Requests;

//use App\Http\Controllers\TareaController;
use Illuminate\Foundation\Http\FormRequest;

class TareaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nombre'    => 'required',
            'descripcion'   => 'nullable',
            'perece'    => 'required|numeric|min:0|max:1',
            'categoria' => 'required',
            'observacion' => 'nullable'
        ];
    }
}
