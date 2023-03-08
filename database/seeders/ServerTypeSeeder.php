<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('server_types')->insert(
            [
                [
                    'name' => 'Jogos',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Clubes escolar',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Grupo de Estudo',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Comunidade Local',
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]
        );
    }
}