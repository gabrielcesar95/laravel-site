<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Password Reset Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match reasons
    | that are given by the password broker for a password update attempt
    | has failed, such as for an invalid token or invalid new password.
    |
    */
    'roles' => [
        'user' => [
            'role' => 'Usuários',
            'permissions' => [
                'user@index' => 'Listagem/Busca',
                'user@show' => 'Dados Detalhados',
                'user@create' => 'Cadastro',
                'user@edit' => 'Edição',
                'user@delete' => 'Exclusão'
            ]
        ],
        'role' => [
            'role' => 'Grupos de Acesso',
            'permissions' => [
                'role@index' => 'Listagem/Busca',
                'role@show' => 'Dados Detalhados',
                'role@create' => 'Cadastro',
                'role@edit' => 'Edição',
                'role@delete' => 'Exclusão'
            ]
        ],
    ],
];
