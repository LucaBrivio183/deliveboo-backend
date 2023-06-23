<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            [
                'name' => 'Vittorio Corradi',
                'email' => 'vitto@prova.it',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Vittoria Romano',
                'email' => 'vitta@prova.it',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Eugenia Rossi',
                'email' => 'eugi@prova.it',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Giorgia Galbulli Cavazzini',
                'email' => 'gio@prova.it',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Luca Brivio',
                'email' => 'lu@prova.it',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'User Uno',
                'email' => 'uno@prova.it',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'User Due',
                'email' => 'due@prova.it',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'User Tre',
                'email' => 'tre@prova.it',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'User Quattro',
                'email' => 'quattro@prova.it',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'User Cinque',
                'email' => 'cinque@prova.it',
                'password' => Hash::make('password')
            ],
        ];

        foreach ($users as $user) {
            $newUser = new User();

            $newUser->name = $user['name'];
            $newUser->email = $user['email'];
            $newUser->password = $user['password'];

            $newUser->save();
        }
    }
}
