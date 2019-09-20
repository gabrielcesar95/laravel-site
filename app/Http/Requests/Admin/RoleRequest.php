<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('role@create') || auth()->user()->can('role@edit');
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
                'min:5',
                'max:64'
            ],
            'permissions' => [
                'required',
                'array'
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
            'name.min' => 'O campo Nome deve ter no mínimo :min caracteres',
            'name.max' => 'O campo Nome deve ter no mínimo :max caracteres',
            'permissions.required' => 'Selecione ao menos uma Permissão',
            'permissions.array' => 'Valor inválido para os campos de Permissões',
            'permissions.*.exists' => 'A Permissão selecionada não existe',
        ];
    }
}
