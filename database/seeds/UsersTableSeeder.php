<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$3K6NFbmX5Novmijk8Tp5J.1iMNTGPgJ4ZDBqcG2txBVsCoq5g/w2u',
                'remember_token' => null,
                'pin_code'       => '',
            ],
        ];

        User::insert($users);
    }
}
