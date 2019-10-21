<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'requester' => [
                'required',
                'max:256',
            ],
            'requester_phone' => [
                'nullable',
                'max:15',
                'celular_com_ddd'
            ],
            'requester_email' => [
                'required',
                'max:256',
                'email'
            ],
            'subject' => [
                'required',
                'max:128'
            ],
            'content' => [
                'required',
                'max:1024'
            ],
        ];
    }

    public function messages()
    {
        return [
            'requester.required' => 'Insira seu nome',
            'requester.max' => 'O nome deve conter no máximo :max caracteres',
            'requester_phone.max' => 'O telefone deve conter no máximo :max caracteres',
            'requester_phone.celular_com_ddd' => 'O telefone informado é inválido',
            'requester_email.required' => 'Insira seu e-mail',
            'requester_email.max' => 'O e-mail deve conter no máximo :max caracteres',
            'requester_email.email' => 'O e-mail informado é inválido',
            'subject.required' => 'Insira o assunto',
            'subject.max' => 'O assunto deve conter no máximo :max caracteres',
            'content.required' => 'Insira uma mensagem',
            'content.max' => 'A mensagem deve conter no máximo :max caracteres',
        ];
    }
}
