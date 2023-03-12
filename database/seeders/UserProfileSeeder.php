<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_profiles')->insert([
            'user_id' => 1,
            'surname' => 'Wilsonrx10',
            'biography' => 'teste',
            'nationality' => 'Angola',
            'city' => 'Luanda',
            'phone' => 943891258,
            'profile_photo' => 'GsWJ0SZE9nxNbseA.jpeg',
            'birth' => '10/10/2001',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
