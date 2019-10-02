<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('post@create') || auth()->user()->can('post@edit');
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
            'subtitle' => [
                'nullable',
                'max: 384',
            ],
            'content' => [
                'required',
            ],
            'cover' => [
                'nullable',
                'image',
                'max:10240',
            ],
            'posted_at' => [
                'nullable',
                'regex:/^(0?[1-9]|[12][0-9]|3[01])\/(0?[1-9]|1[0-2])\/\d\d\d\d (00|0[0-9]|[0-9]|1[0-9]|2[0-3]):([0-9]|[0-5][0-9])$/i'
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
            'subtitle.required' => 'O campo Subtítulo é obrigatório',
            'subtitle.max' => 'O campo Subtítulo deve ter no máximo :max caracteres',
            'content.required' => 'O campo Conteúdo é obrigatório',
            'cover.image' => 'O campo Imagem de Capa deve receber uma imagem (jpeg, png, bmp, gif, svg, or webp)',
            'cover.max' => 'O campo Imagem de Capa deve ter no máximo :max caracteres',
            'posted_at.regex' => 'O campo Data de Postagem deve receber um valor válido no formato DD/MM/YYYY HH:MM',
        ];
    }
}
