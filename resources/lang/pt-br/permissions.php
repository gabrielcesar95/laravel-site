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
        'logs' => [
            'role' => 'Logs',
            'permissions' => [
                'logs@index' => 'Listagem/Busca',
                'logs@show' => 'Dados Detalhados',
            ]
        ],
        'category' => [
            'role' => 'Categorias',
            'permissions' => [
                'category@index' => 'Listagem/Busca',
                'category@show' => 'Dados Detalhados',
                'category@create' => 'Cadastro',
                'category@edit' => 'Edição',
                'category@delete' => 'Exclusão'
            ]
        ],
        'post' => [
            'role' => 'Postagens',
            'permissions' => [
                'post@index' => 'Listagem/Busca',
                'post@show' => 'Dados Detalhados',
                'post@create' => 'Cadastro',
                'post@edit' => 'Edição',
                'post@delete' => 'Exclusão'
            ]
        ],
        'comment' => [
            'role' => 'Comentários',
            'permissions' => [
                'comment@index' => 'Listagem/Busca',
                'comment@show' => 'Dados Detalhados',
                'comment@create' => 'Cadastro',
                'comment@edit' => 'Edição',
                'comment@delete' => 'Exclusão'
            ]
        ],
        'contact' => [
            'role' => 'Requisições de Contato',
            'permissions' => [
                'contact@index' => 'Listagem/Busca',
                'contact@show' => 'Dados Detalhados',
                'contact@delete' => 'Exclusão'
            ]
        ],
    ],
];
