<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FriendStatusTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('friend_status_types')->insert([
            [
                'name' => 'Bloqueado',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Aceite',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pendente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Suspenso',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}