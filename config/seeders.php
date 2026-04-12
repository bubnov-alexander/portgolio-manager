<?php

return [
    'super_admin' => [
        'email' => env('SEED_SUPER_ADMIN_EMAIL', 'admin@admin.com'),
        'password' => env('SEED_SUPER_ADMIN_PASSWORD', 'admin'),
        'name' => env('SEED_SUPER_ADMIN_NAME', 'Super Admin'),
    ],
];
