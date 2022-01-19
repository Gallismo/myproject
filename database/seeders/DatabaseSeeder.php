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
            [
                'id' => 1, 'login' => 'sperecur',
                'password' => '$2y$10$.tT/C.EqF4.Z9Z0hR.ebn.G/xOEc63d6n7rJVGjc3FlcRNNJqvms.', 'role_id' => '1',
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        DB::table('roles')->insert($roles);
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert($admin);

    }
}
