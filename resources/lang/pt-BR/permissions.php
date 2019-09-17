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
                'user_index' => 'Listagem/Busca',
                'user_show' => 'Dados Detalhados',
                'user_create' => 'Cadastro',
                'user_edit' => 'Edição',
                'user_delete' => 'Exclusão'
            ]
        ],
        'role' => [
            'role' => 'Grupos de Acesso',
            'permissions' => [
                'role_index' => 'Listagem/Busca',
                'role_show' => 'Dados Detalhados',
                'role_create' => 'Cadastro',
                'role_edit' => 'Edição',
                'role_delete' => 'Exclusão'
            ]
        ],
    ],
];
