<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'user_name' => 'いぬしましんいち',
            'account_name' => 'inushima',
            'admin' => 'admin',
            'email' => 'example@gmail.com',
            'email_verified_at' => '0000-00-00 00:00:00',
            'password' => Hash::make('12345678'),
            'gender' => '0',
            'birth' => '1990-11-07',
            'created_at' => '2024-05-08 16:19:17',
            'updated_at' => '2024-05-08 16:19:17',
           ]);
    }
}
