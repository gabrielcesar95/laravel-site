<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('user@create') || auth()->user()->can('user@edit');
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
                'max:255'
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email,' . $this->id
            ],
            'active' => [
                'boolean'
            ],
            'password' => [
                'nullable',
                'confirmed',
                'min:5'
            ],
            'password_confirmation' => [
                'required_with:password'
            ],
            'roles' => [
                'nullable',
                'array'
            ],
            'roles.*' => [
                'exists:' . config('permission.table_names.roles') . ',id'
            ],
            'permissions' => [
                'nullable',
                'array'
            ],
            'permissions.*' => [
                'exists:' . config('permission.table_names.permissions') . ',id'
            ],
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
            'name.max' => 'O campo Nome deve ter no mínimo :max caracteres',
            'email.required' => 'O campo e-mail é obrigatório',
            'email.email' => 'O e-mail digitado é inválido',
            'email.unique' => 'O e-mail digitado já está cadastrado',
            'active.boolean' => 'Valor inválido para o campo Ativo',
            'password.confirmed' => 'Os valores de Senha e Confirmação de Senha devem ser iguais',
            'password.min' => 'O campo Senha deve ter no mínimo :min caracteres',
            'password_confirmation.required_with' => 'O campo Confirmação de Senha é obrigatório',
            'roles.array' => 'Valor inválido para os campos de Grupos de Acesso',
            'roles.*.exists' => 'O Grupo de Acesso selecionado não existe',
            'permissions.array' => 'Valor inválido para os campos de Permissões Diretas',
            'permissions.*.exists' => 'A Permissão selecionada não existe',
        ];
    }
}
