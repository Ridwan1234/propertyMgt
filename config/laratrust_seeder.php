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
        'admin' => [
            'landlord' => 'c,r,u,d',
            'tenant' => 'c,r,u,d',
            'property' => 'c,r,u,d',
            'unit' => 'c,r,u,d',
            'lease' => 'c,r,u,d',
            'invoice' => 'r,u,d',
            'user' => 'c,r,u,d',
            'inventory' => 'c,r,u,d',
            'event' => 'c,r,u,d',
            'lease_history' => 'r,d',
        ],
        'tenant' => [],
        'landlord' => [],
        'user' => [],
        'staff' => [],
        'agent' => [],


    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
