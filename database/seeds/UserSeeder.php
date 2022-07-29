<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run()
    {
        $users = [
            [
                'name'      => 'asdf',
                'email'     => 'asdf@asdf.asdf',
                'password'  => Hash::make('asdf'),
            ],
            [
                'name'      => 'qwer',
                'email'     => 'qwer@qwer.qwer',
                'password'  => Hash::make('qwer'),
            ],
            [
                'name'      => 'zxcv',
                'email'     => 'zxcv@zxcv.zxcv',
                'password'  => Hash::make('zxcv'),
            ],
            [
                'name'      => 'uiop',
                'email'     => 'uiop@uiop.uiop',
                'password'  => Hash::make('uiop'),
            ],
            [
                'name'      => 'mnbv',
                'email'     => 'mnbv@mnbv.mnbv',
                'password'  => Hash::make('mnbv'),
            ],

        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
