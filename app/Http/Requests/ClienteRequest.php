<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ClienteRequest extends FormRequest
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
             'name' => 'string|required',
            'email' => 'email|required',
            'imagem' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'telefone1' => 'string|required',
            'telefone2' => 'nullable',
            'tipo_pessoa' => 'string|required',
        ];
    }
}
