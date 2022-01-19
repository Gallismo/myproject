<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['id' => 1, 'name' => 'Администратор'],
            ['id' => 2, 'name' => 'Преподаватель'],
            ['id' => 3, 'name' => 'Староста']
        ];

        $admin = [
            ['id' => 1, 'name' => 'Admin', 'login' => 'sperecur', 'password' => 'qLZ2dpFvqptye6Cg', 'role_id' => '1']
        ];

        DB::table('roles')->insert($roles);
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert($admin);

    }
}
