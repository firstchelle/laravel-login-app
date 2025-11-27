<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Rektor',
            'email' => 'rektor@mail.com',
            'password' => bcrypt('password'),
            'role' => 'rektor'
        ]);

        User::create([
            'name' => 'Dekan',
            'email' => 'dekan@mail.com',
            'password' => bcrypt('password'),
            'role' => 'dekan'
        ]);

        User::create([
            'name' => 'Kaprodi',
            'email' => 'kaprodi@mail.com',
            'password' => bcrypt('password'),
            'role' => 'kaprodi'
        ]);
    }
}
