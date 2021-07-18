<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSerieRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'serie' => 'required|min:3'
        ];
    }

    public function messages()
    {
        return [
            'serie.required' => 'O campo "Nome" é obrigatório',
            'serie.min' => 'O campo "Nome" precisa ter pelo menos 3 caracteres'
        ];
    }
}
