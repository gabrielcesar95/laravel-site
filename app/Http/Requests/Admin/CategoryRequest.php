<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('category@create') || auth()->user()->can('category@edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'max:64',
            ],
            'description' => [
                'nullable',
                'max: 384',
            ],
            'cover' => [
                'nullable',
                'image',
                'max:10240',
            ]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'O campo Nome é obrigatório',
            'name.max' => 'O campo Nome deve ter no máximo :max caracteres',
            'description.required' => 'O campo Descrição é obrigatório',
            'description.max' => 'O campo Descrição deve ter no máximo :max caracteres',
            'cover.image' => 'O campo Imagem de Capa deve receber uma imagem (jpeg, png, bmp, gif, svg, or webp)',
            'cover.max' => 'O campo Imagem de Capa deve ter no máximo :max caracteres',
        ];
    }
}
