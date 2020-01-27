<?php

namespace App\Http\Requests\Api;

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
        return request()->user()->can('user@create') || request()->user()->can('user@edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
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
            'avatar' => [
                'nullable',
                'image',
                'max:10240',
            ],
            'password' => [
                'required',
                'min:5'
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


        if (request()->method() == 'PUT') {
            $rules['password'] = [
                'nullable',
                'min:5'
            ];
            $rules['name'] = [
                'nullable',
                'max:255'
            ];
            $rules['email'] = [
                'nullable',
                'email',
                'unique:users,email,' . $this->id
            ];
        }

        return $rules;
    }
}
