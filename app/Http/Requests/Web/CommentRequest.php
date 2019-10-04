<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->hasRole('user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => [
                'required',
                'max:640'
            ]
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'Você deve digitar um comentário',
            'content.max' => 'O comentário deve ter no máximo :max caracteres'
        ];
    }
}
