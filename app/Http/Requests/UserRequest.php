<?php

namespace App\Http\Requests;

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
            'name' => [
                'required',
                'min:5',
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
}

// TODO: Adicionar textos de validação
