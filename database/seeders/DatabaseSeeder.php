<?php

namespace Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        (new \Database\Seeders\UserSeeder())->run();
        (new \Database\Seeders\UserProfileSeeder())->run();
        (new \Database\Seeders\UserStatusTypeSeeder())->run();
        (new \Database\Seeders\ServerTypeSeeder())->run();
        (new \Database\Seeders\FriendStatusTypeSeeder())->run();
    }
}