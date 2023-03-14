<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserStatusTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_status_types')->insert([
            [
                'name' => 'Disponivel',
                'body' => NULL,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Ausente',
                'body' => NUll,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Invisivel',
                'body' => 'Você não vai aparecer como disponivel, mas tera seu perfil disponivel',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Não Pertubar',
                'body' => 'Você não ira mais receber notificações na area de trabalho',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}