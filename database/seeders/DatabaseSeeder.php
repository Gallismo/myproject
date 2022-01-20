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

        $departments = [
            ['id' => 1, 'name' => 'Технологическое', 'code' => $this->code()],
            ['id' => 2, 'name' => 'Экономическое', 'code' => $this->code()],
        ];

        $audiences = [
            ['id' => 1, 'name' => '30', 'code' => $this->code()],
            ['id' => 2, 'name' => '31', 'code' => $this->code()],
            ['id' => 3, 'name' => '32', 'code' => $this->code()],
            ['id' => 4, 'name' => '33', 'code' => $this->code()],
            ['id' => 5, 'name' => '34', 'code' => $this->code()],
            ['id' => 6, 'name' => '35', 'code' => $this->code()],
            ['id' => 7, 'name' => '36', 'code' => $this->code()],
            ['id' => 8, 'name' => '37', 'code' => $this->code()],
            ['id' => 9, 'name' => '38', 'code' => $this->code()],
            ['id' => 10, 'name' => 'Спортивный зал', 'code' => $this->code()],
        ];

        $groupPart = [
            ['id' => 1, 'name' => 'Вся группа', 'code' => $this->code()],
            ['id' => 2, 'name' => 'Первая подгруппа', 'code' => $this->code()],
            ['id' => 3, 'name' => 'Вторая подгруппа', 'code' => $this->code()],
        ];

        $lessonOrd = [
            ['id' => 1, 'name' => 1, 'code' => $this->code()],
            ['id' => 2, 'name' => 2, 'code' => $this->code()],
            ['id' => 3, 'name' => 3, 'code' => $this->code()],
            ['id' => 4, 'name' => 4, 'code' => $this->code()],
            ['id' => 5, 'name' => 5, 'code' => $this->code()],
            ['id' => 6, 'name' => 6, 'code' => $this->code()],
            ['id' => 7, 'name' => 7, 'code' => $this->code()],
        ];

        $subjects = [
            ['id' => 1, 'name' => 'Математика', 'code' => $this->code()],
            ['id' => 2, 'name' => 'МДК', 'code' => $this->code()],
            ['id' => 3, 'name' => 'Спец рисунок', 'code' => $this->code()],
            ['id' => 4, 'name' => 'Физра', 'code' => $this->code()],
            ['id' => 5, 'name' => 'Ботаника', 'code' => $this->code()],
            ['id' => 6, 'name' => 'Физика', 'code' => $this->code()],
            ['id' => 7, 'name' => 'Граф дизайн', 'code' => $this->code()]
        ];

        DB::table('roles')->insert($roles);
        DB::table('users')->insert($admin);
        DB::table('departments')->insert($departments);
        DB::table('audiences')->insert($audiences);
        DB::table('groups_parts')->insert($groupPart);
        DB::table('lessons_orders')->insert($lessonOrd);
        DB::table('subjects')->insert($subjects);


    }

    private function code() {
        $symbols = "QWERTYUIOPASDFGHJKLZXCVBNM123456789qwertyuiopasdfghjklzxcvbnm";
        $code = "";

        for ($i=0;$i<30;$i++) {
            if ($i % 10 == 0 && $i>1) {
                $code .= '-';
            }
            $code .= substr($symbols, rand(1, 61) - 1, 1);
        }

        return $code;
    }
}
