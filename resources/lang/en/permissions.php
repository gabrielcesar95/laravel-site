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
            'role' => 'Users',
            'permissions' => [
                'user@index' => 'List/Search',
                'user@show' => 'Detailed Data',
                'user@create' => 'Create',
                'user@edit' => 'Edit',
                'user@delete' => 'Delete'
            ]
        ],
        'role' => [
            'role' => 'Grupos de Acesso',
            'permissions' => [
                'role@index' => 'List/Search',
                'role@show' => 'Detailed Data',
                'role@create' => 'Create',
                'role@edit' => 'Edit',
                'role@delete' => 'Delete'
            ]
        ],
        'logs' => [
            'role' => 'Logs',
            'permissions' => [
                'logs@index' => 'List/Search',
                'logs@show' => 'Detailed Data',
            ]
        ],
        'category' => [
            'role' => 'Categorias',
            'permissions' => [
                'category@index' => 'List/Search',
                'category@show' => 'Detailed Data',
                'category@create' => 'Create',
                'category@edit' => 'Edit',
                'category@delete' => 'Delete'
            ]
        ],
        'post' => [
            'role' => 'Postagens',
            'permissions' => [
                'post@index' => 'List/Search',
                'post@show' => 'Detailed Data',
                'post@create' => 'Create',
                'post@edit' => 'Edit',
                'post@delete' => 'Delete'
            ]
        ],
        'comment' => [
            'role' => 'Comentários',
            'permissions' => [
                'comment@index' => 'List/Search',
                'comment@show' => 'Detailed Data',
                'comment@create' => 'Create',
                'comment@edit' => 'Edit',
                'comment@delete' => 'Delete'
            ]
        ],
        'contact' => [
            'role' => 'Contact Requests',
            'permissions' => [
                'contact@index' => 'List/Search',
                'contact@show' => 'Detailed Data',
                'contact@delete' => 'Delete'
            ]
        ],
    ],
];
