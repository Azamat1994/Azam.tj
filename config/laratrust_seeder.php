<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
//        'superadministrator' => [
//            'users' => 'c,r,u,d',
//            'payments' => 'c,r,u,d',
//            'profile' => 'r,u'
//        ],
        'administrator' => [
//            'users' => 'c,r,u,d',
//            'profile' => 'r,u'
            'roles' => 'c,r,u,d',
            'permissions' => 'c,r,u,d',
            'deliveries' => 'c,r,u,d',
            'users' => 'c,r,u,d',
            'units' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'cities' => 'c,r,u,d',
            'partners' => 'c,r,u,d',
            'products' => 'c,r,u,d',
            'crudes' => 'c,r,u,d',
            'warehouses' => 'c,r,u,d',
            'statuses' => 'c,r,u,d',
            'sliders' => 'c,r,u,d',
            'orders' => 'c,r,u,d',
            'posts' => 'c,r,u,d',
            'shops' => 'c,r,u,d',
        ],
        'moderator' => [
//            'users' => 'c,r,u,d',
//            'profile' => 'r,u'
            'deliveries' => 'c,r,u,d',
            'users' => 'c,r,u,d',
            'units' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'cities' => 'c,r,u,d',
            'partners' => 'c,r,u,d',
            'products' => 'c,r,u,d',
            'crudes' => 'c,r,u,d',
            'warehouses' => 'c,r,u,d',
            'statuses' => 'c,r,u,d',
            'sliders' => 'c,r,u,d',
            'orders' => 'c,r,u,d',
            'posts' => 'c,r,u,d',
            'shops' => 'c,r,u,d',
        ],
        'user' => [
//            'profile' => 'r,u',
            'deliveries' => 'r',
            'users' => 'r',
            'units' => 'r',
            'categories' => 'r',
            'cities' => 'r',
            'partners' => 'r',
            'products' => 'r',
            'crudes' => 'r',
            'warehouses' => 'r',
            'statuses' => 'r',
            'sliders' => 'r',
            'orders' => 'r',
            'posts' => 'r',
            'shops' => 'r',
        ],
//        'role_name' => [
//            'module_1_name' => 'c,r,u,d',
//        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
