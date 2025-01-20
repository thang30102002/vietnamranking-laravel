<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->upsert([
            [
                'id' => '100',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('Thang30102002@'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ], ['id'], ['email', 'password']);

        DB::table('user_roles')->upsert([
            [
                'id' => '100',
                'user_id' => '100',
                'role_id' => '1',
            ]
        ], ['id'], ['user_id', 'role_id']);
    }
}
