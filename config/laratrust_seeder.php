<?php

return [
    'role_structure' => [
        'super_admin' => [
            'tickets' => 'c,r,u,d',

            'users' => 'c,r,u,d',
        ],
        'admin' => [],
        'users' => []
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
