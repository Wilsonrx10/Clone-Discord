<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Wilson Manuel',
                'email' => 'teste@gmail.com',
                'password' => Hash::make(123456),
                'ativo_account' => 0,
                'cad_concluir' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}