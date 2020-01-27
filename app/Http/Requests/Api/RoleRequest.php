<?php

namespace App\Http\Requests\Api;

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
        return request()->user()->can('role@create') || request()->user()->can('role@edit');
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
                'min:5',
                'max:64'
            ],
            'permissions' => [
                'required',
                'array'
            ],
            'permissions.*' => [
                'exists:permissions,name'
            ]
        ];


        if (request()->method() == 'PUT') {
            $rules['permissions'] = [
                'nullable',
                'array',
            ];
        }

        return $rules;
    }
}
