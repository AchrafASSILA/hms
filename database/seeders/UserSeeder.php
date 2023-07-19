<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            'name' => 'achrafassila',
            'role' => 1,
            'auth_key' => '123456',
            'email' => 'achrafassila678@gmail.com',
            'password' => Hash::make('12345678'),
            'phone' => '0634328147',
            'adress' => 'morocco,casablanca',
        ]);
    }
}
