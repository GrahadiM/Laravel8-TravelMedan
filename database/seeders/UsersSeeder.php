<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => 1
        ]);

        User::create([
            'name' => 'customer',
            'email' => 'customer@example.com',
            'password' => bcrypt('password'),
            'is_admin' => 0
        ]);
    }
}
