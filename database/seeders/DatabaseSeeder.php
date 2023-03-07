<?php

namespace Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        (new \Database\Seeders\UserSeeder())->run();
        (new \Database\Seeders\user_profileSeeder())->run();
    }
}