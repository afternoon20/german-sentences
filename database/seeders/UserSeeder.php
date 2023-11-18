<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // php artisan db:seed --class=UserSeeder
        \App\Models\User::create([
            'login_id' => 'test',
            'name' => 'test',
            'password' => Hash::make('password'),
        ]);
    }
}
