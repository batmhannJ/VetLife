<?php

return [

    'defaults' => [
        'guard'     => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver'   => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver'   => 'passport',
            'provider' => 'users',
            'hash'     => false,
        ],

        'admin' => [ // ADD THIS
            'driver'   => 'session',
            'provider' => 'admins',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model'  => App\User::class,
        ],

        'admins' => [ // ADD THIS
            'driver' => 'eloquent',
            'model'  => App\Models\Admin::class, // Ensure you have this model
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table'    => 'password_resets',
            'expire'   => 60,
        ],
    ],

];
