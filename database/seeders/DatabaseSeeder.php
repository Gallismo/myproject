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

        $groups = [
            [
                'name' => 'И-19-19',
                'department_id' => '2',
                'start_year' => 2019,
                'end_year' => 2023,
                'code' => $this->code()
            ]
        ];

        $users = [
            [
                'id' => 1, 'login' => 'sperecur', 'name' => 'Администратор',
                'password' => '$2y$10$JYQwDahA9uP8KImn/73ngeKFSmXhCsbrZafi7Bz9z5lGMZs1sht7a', 'role_id' => '1', 'group_id' => null,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2, 'login' => 'starosta', 'name' => 'Федоров Георгий Владимирович',
                'password' => '$2y$10$JYQwDahA9uP8KImn/73ngeKFSmXhCsbrZafi7Bz9z5lGMZs1sht7a', 'role_id' => '3', 'group_id' => 1,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3, 'name' => 'Иванов Иван Иванович', 'login' => 'prepod',
                'password' => '$2y$10$JYQwDahA9uP8KImn/73ngeKFSmXhCsbrZafi7Bz9z5lGMZs1sht7a', 'role_id' => '2', 'group_id' => null,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')
            ],
        ];

        $teachers = [
            [
                'name' => 'Иванов Иван Иванович',
                'user_id' => '3',
                'code' => $this->code()
            ]
        ];

        $starosts = [
            [
                'name' => 'Федоров Георгий Владимирович',
                'user_id' => '2',
                'group_id' => '1',
                'code' => $this->code()
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
            ['id' => 8, 'name' => 'Классный час', 'code' => $this->code()],
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

        $weeks = [
            ['id' => 1, 'name' => 'Понедельник', 'code' => $this->code()],
            ['id' => 2, 'name' => 'Вторник', 'code' => $this->code()],
            ['id' => 3, 'name' => 'Среда', 'code' => $this->code()],
            ['id' => 4, 'name' => 'Четверг', 'code' => $this->code()],
            ['id' => 5, 'name' => 'Пятница', 'code' => $this->code()],
            ['id' => 6, 'name' => 'Суббота', 'code' => $this->code()],
            ['id' => 7, 'name' => 'Воскресенье', 'code' => $this->code()],
        ];

        $schedules = [
//            poned Tech
            ['week_day_id' => 1, 'lesson_order_id' => 1, 'department_id' => 1,
                'start_time' => '08:45:00', 'end_time' => '10:05:00', 'break' => 10, 'code' => $this->code()],
            ['week_day_id' => 1, 'lesson_order_id' => 2, 'department_id' => 1,
                'start_time' => '10:15:00', 'end_time' => '11:35:00', 'break' => 15, 'code' => $this->code()],
            ['week_day_id' => 1, 'lesson_order_id' => 3, 'department_id' => 1,
                'start_time' => '11:50:00', 'end_time' => '13:10:00', 'break' => 45, 'code' => $this->code()],
            ['week_day_id' => 1, 'lesson_order_id' => 4, 'department_id' => 1,
                'start_time' => '13:55:00', 'end_time' => '15:15:00', 'break' => 5, 'code' => $this->code()],
            ['week_day_id' => 1, 'lesson_order_id' => 5, 'department_id' => 1,
                'start_time' => '15:20:00', 'end_time' => '16:40:00', 'break' => 20, 'code' => $this->code()],
            ['week_day_id' => 1, 'lesson_order_id' => 6, 'department_id' => 1,
                'start_time' => '17:00:00', 'end_time' => '18:20:00', 'break' => 5, 'code' => $this->code()],
            ['week_day_id' => 1, 'lesson_order_id' => 7, 'department_id' => 1,
                'start_time' => '18:25:00', 'end_time' => '19:45:00', 'break' => 0, 'code' => $this->code()],

            ['week_day_id' => 2, 'lesson_order_id' => 1, 'department_id' => 1,
                'start_time' => '08:45:00', 'end_time' => '10:05:00', 'break' => 10, 'code' => $this->code()],
            ['week_day_id' => 2, 'lesson_order_id' => 2, 'department_id' => 1,
                'start_time' => '10:15:00', 'end_time' => '11:35:00', 'break' => 15, 'code' => $this->code()],
            ['week_day_id' => 2, 'lesson_order_id' => 3, 'department_id' => 1,
                'start_time' => '11:50:00', 'end_time' => '13:10:00', 'break' => 5, 'code' => $this->code()],
            ['week_day_id' => 2, 'lesson_order_id' => 8, 'department_id' => 1,
                'start_time' => '13:15:00', 'end_time' => '13:55:00', 'break' => 40, 'code' => $this->code()],
            ['week_day_id' => 2, 'lesson_order_id' => 4, 'department_id' => 1,
                'start_time' => '14:35:00', 'end_time' => '15:55:00', 'break' => 5, 'code' => $this->code()],
            ['week_day_id' => 2, 'lesson_order_id' => 5, 'department_id' => 1,
                'start_time' => '16:00:00', 'end_time' => '17:20:00', 'break' => 15, 'code' => $this->code()],
            ['week_day_id' => 2, 'lesson_order_id' => 6, 'department_id' => 1,
                'start_time' => '17:35:00', 'end_time' => '18:55:00', 'break' => 0, 'code' => $this->code()],
//            sreda Tech
            ['week_day_id' => 3, 'lesson_order_id' => 1, 'department_id' => 1,
                'start_time' => '08:45:00', 'end_time' => '10:05:00', 'break' => 10, 'code' => $this->code()],
            ['week_day_id' => 3, 'lesson_order_id' => 2, 'department_id' => 1,
                'start_time' => '10:15:00', 'end_time' => '11:35:00', 'break' => 15, 'code' => $this->code()],
            ['week_day_id' => 3, 'lesson_order_id' => 3, 'department_id' => 1,
                'start_time' => '11:50:00', 'end_time' => '13:10:00', 'break' => 45, 'code' => $this->code()],
            ['week_day_id' => 3, 'lesson_order_id' => 4, 'department_id' => 1,
                'start_time' => '13:55:00', 'end_time' => '15:15:00', 'break' => 5, 'code' => $this->code()],
            ['week_day_id' => 3, 'lesson_order_id' => 5, 'department_id' => 1,
                'start_time' => '15:20:00', 'end_time' => '16:40:00', 'break' => 20, 'code' => $this->code()],
            ['week_day_id' => 3, 'lesson_order_id' => 6, 'department_id' => 1,
                'start_time' => '17:00:00', 'end_time' => '18:20:00', 'break' => 5, 'code' => $this->code()],
            ['week_day_id' => 3, 'lesson_order_id' => 7, 'department_id' => 1,
                'start_time' => '18:25:00', 'end_time' => '19:45:00', 'break' => 0, 'code' => $this->code()],
//            Chet Tech
            ['week_day_id' => 4, 'lesson_order_id' => 1, 'department_id' => 1,
                'start_time' => '08:45:00', 'end_time' => '10:05:00', 'break' => 10, 'code' => $this->code()],
            ['week_day_id' => 4, 'lesson_order_id' => 2, 'department_id' => 1,
                'start_time' => '10:15:00', 'end_time' => '11:35:00', 'break' => 15, 'code' => $this->code()],
            ['week_day_id' => 4, 'lesson_order_id' => 3, 'department_id' => 1,
                'start_time' => '11:50:00', 'end_time' => '13:10:00', 'break' => 45, 'code' => $this->code()],
            ['week_day_id' => 4, 'lesson_order_id' => 4, 'department_id' => 1,
                'start_time' => '13:55:00', 'end_time' => '15:15:00', 'break' => 5, 'code' => $this->code()],
            ['week_day_id' => 4, 'lesson_order_id' => 5, 'department_id' => 1,
                'start_time' => '15:20:00', 'end_time' => '16:40:00', 'break' => 20, 'code' => $this->code()],
            ['week_day_id' => 4, 'lesson_order_id' => 6, 'department_id' => 1,
                'start_time' => '17:00:00', 'end_time' => '18:20:00', 'break' => 5, 'code' => $this->code()],
            ['week_day_id' => 4, 'lesson_order_id' => 7, 'department_id' => 1,
                'start_time' => '18:25:00', 'end_time' => '19:45:00', 'break' => 0, 'code' => $this->code()],
//            Pt Tech
            ['week_day_id' => 5, 'lesson_order_id' => 1, 'department_id' => 1,
                'start_time' => '08:45:00', 'end_time' => '10:05:00', 'break' => 10, 'code' => $this->code()],
            ['week_day_id' => 5, 'lesson_order_id' => 2, 'department_id' => 1,
                'start_time' => '10:15:00', 'end_time' => '11:35:00', 'break' => 15, 'code' => $this->code()],
            ['week_day_id' => 5, 'lesson_order_id' => 3, 'department_id' => 1,
                'start_time' => '11:50:00', 'end_time' => '13:10:00', 'break' => 45, 'code' => $this->code()],
            ['week_day_id' => 5, 'lesson_order_id' => 4, 'department_id' => 1,
                'start_time' => '13:55:00', 'end_time' => '15:15:00', 'break' => 5, 'code' => $this->code()],
            ['week_day_id' => 5, 'lesson_order_id' => 5, 'department_id' => 1,
                'start_time' => '15:20:00', 'end_time' => '16:40:00', 'break' => 20, 'code' => $this->code()],
            ['week_day_id' => 5, 'lesson_order_id' => 6, 'department_id' => 1,
                'start_time' => '17:00:00', 'end_time' => '18:20:00', 'break' => 5, 'code' => $this->code()],
            ['week_day_id' => 5, 'lesson_order_id' => 7, 'department_id' => 1,
                'start_time' => '18:25:00', 'end_time' => '19:45:00', 'break' => 0, 'code' => $this->code()],

            ['week_day_id' => 6, 'lesson_order_id' => 1, 'department_id' => 1,
                'start_time' => '08:45:00', 'end_time' => '10:05:00', 'break' => 10, 'code' => $this->code()],
            ['week_day_id' => 6, 'lesson_order_id' => 2, 'department_id' => 1,
                'start_time' => '10:15:00', 'end_time' => '11:35:00', 'break' => 30, 'code' => $this->code()],
            ['week_day_id' => 6, 'lesson_order_id' => 3, 'department_id' => 1,
                'start_time' => '12:05:00', 'end_time' => '13:25:00', 'break' => 5, 'code' => $this->code()],
            ['week_day_id' => 6, 'lesson_order_id' => 4, 'department_id' => 1,
                'start_time' => '13:30:00', 'end_time' => '14:50:00', 'break' => 0, 'code' => $this->code()],

            ['week_day_id' => 1, 'lesson_order_id' => 1, 'department_id' => 2,
                'start_time' => '08:30:00', 'end_time' => '09:50:00', 'break' => 5, 'code' => $this->code()],
            ['week_day_id' => 1, 'lesson_order_id' => 2, 'department_id' => 2,
                'start_time' => '09:55:00', 'end_time' => '11:15:00', 'break' => 5, 'code' => $this->code()],
            ['week_day_id' => 1, 'lesson_order_id' => 3, 'department_id' => 2,
                'start_time' => '11:20:00', 'end_time' => '12:40:00', 'break' => 40, 'code' => $this->code()],
            ['week_day_id' => 1, 'lesson_order_id' => 4, 'department_id' => 2,
                'start_time' => '13:20:00', 'end_time' => '14:40:00', 'break' => 10, 'code' => $this->code()],
            ['week_day_id' => 1, 'lesson_order_id' => 5, 'department_id' => 2,
                'start_time' => '14:50:00', 'end_time' => '16:10:00', 'break' => 25, 'code' => $this->code()],
            ['week_day_id' => 1, 'lesson_order_id' => 6, 'department_id' => 2,
                'start_time' => '16:35:00', 'end_time' => '17:55:00', 'break' => 10, 'code' => $this->code()],
            ['week_day_id' => 1, 'lesson_order_id' => 7, 'department_id' => 2,
                'start_time' => '18:05:00', 'end_time' => '19:25:00', 'break' => 0, 'code' => $this->code()],

            ['week_day_id' => 2, 'lesson_order_id' => 1, 'department_id' => 2,
                'start_time' => '08:30:00', 'end_time' => '09:50:00', 'break' => 5, 'code' => $this->code()],
            ['week_day_id' => 2, 'lesson_order_id' => 2, 'department_id' => 2,
                'start_time' => '09:55:00', 'end_time' => '11:15:00', 'break' => 5, 'code' => $this->code()],
            ['week_day_id' => 2, 'lesson_order_id' => 3, 'department_id' => 2,
                'start_time' => '11:20:00', 'end_time' => '12:40:00', 'break' => 40, 'code' => $this->code()],
            ['week_day_id' => 2, 'lesson_order_id' => 8, 'department_id' => 2,
                'start_time' => '13:20:00', 'end_time' => '14:00:00', 'break' => 0, 'code' => $this->code()],
            ['week_day_id' => 2, 'lesson_order_id' => 4, 'department_id' => 2,
                'start_time' => '14:00:00', 'end_time' => '15:20:00', 'break' => 10, 'code' => $this->code()],
            ['week_day_id' => 2, 'lesson_order_id' => 5, 'department_id' => 2,
                'start_time' => '15:30:00', 'end_time' => '16:50:00', 'break' => 25, 'code' => $this->code()],
            ['week_day_id' => 2, 'lesson_order_id' => 6, 'department_id' => 2,
                'start_time' => '17:15:00', 'end_time' => '18:35:00', 'break' => 0, 'code' => $this->code()],

            ['week_day_id' => 3, 'lesson_order_id' => 1, 'department_id' => 2,
                'start_time' => '08:30:00', 'end_time' => '09:50:00', 'break' => 5, 'code' => $this->code()],
            ['week_day_id' => 3, 'lesson_order_id' => 2, 'department_id' => 2,
                'start_time' => '09:55:00', 'end_time' => '11:15:00', 'break' => 5, 'code' => $this->code()],
            ['week_day_id' => 3, 'lesson_order_id' => 3, 'department_id' => 2,
                'start_time' => '11:20:00', 'end_time' => '12:40:00', 'break' => 40, 'code' => $this->code()],
            ['week_day_id' => 3, 'lesson_order_id' => 4, 'department_id' => 2,
                'start_time' => '13:20:00', 'end_time' => '14:40:00', 'break' => 10, 'code' => $this->code()],
            ['week_day_id' => 3, 'lesson_order_id' => 5, 'department_id' => 2,
                'start_time' => '14:50:00', 'end_time' => '16:10:00', 'break' => 25, 'code' => $this->code()],
            ['week_day_id' => 3, 'lesson_order_id' => 6, 'department_id' => 2,
                'start_time' => '16:35:00', 'end_time' => '17:55:00', 'break' => 10, 'code' => $this->code()],
            ['week_day_id' => 3, 'lesson_order_id' => 7, 'department_id' => 2,
                'start_time' => '18:05:00', 'end_time' => '19:25:00', 'break' => 0, 'code' => $this->code()],

            ['week_day_id' => 4, 'lesson_order_id' => 1, 'department_id' => 2,
                'start_time' => '08:30:00', 'end_time' => '09:50:00', 'break' => 5, 'code' => $this->code()],
            ['week_day_id' => 4, 'lesson_order_id' => 2, 'department_id' => 2,
                'start_time' => '09:55:00', 'end_time' => '11:15:00', 'break' => 5, 'code' => $this->code()],
            ['week_day_id' => 4, 'lesson_order_id' => 3, 'department_id' => 2,
                'start_time' => '11:20:00', 'end_time' => '12:40:00', 'break' => 40, 'code' => $this->code()],
            ['week_day_id' => 4, 'lesson_order_id' => 4, 'department_id' => 2,
                'start_time' => '13:20:00', 'end_time' => '14:40:00', 'break' => 10, 'code' => $this->code()],
            ['week_day_id' => 4, 'lesson_order_id' => 5, 'department_id' => 2,
                'start_time' => '14:50:00', 'end_time' => '16:10:00', 'break' => 25, 'code' => $this->code()],
            ['week_day_id' => 4, 'lesson_order_id' => 6, 'department_id' => 2,
                'start_time' => '16:35:00', 'end_time' => '17:55:00', 'break' => 10, 'code' => $this->code()],
            ['week_day_id' => 4, 'lesson_order_id' => 7, 'department_id' => 2,
                'start_time' => '18:05:00', 'end_time' => '19:25:00', 'break' => 0, 'code' => $this->code()],

            ['week_day_id' => 5, 'lesson_order_id' => 1, 'department_id' => 2,
                'start_time' => '08:30:00', 'end_time' => '09:50:00', 'break' => 5, 'code' => $this->code()],
            ['week_day_id' => 5, 'lesson_order_id' => 2, 'department_id' => 2,
                'start_time' => '09:55:00', 'end_time' => '11:15:00', 'break' => 5, 'code' => $this->code()],
            ['week_day_id' => 5, 'lesson_order_id' => 3, 'department_id' => 2,
                'start_time' => '11:20:00', 'end_time' => '12:40:00', 'break' => 40, 'code' => $this->code()],
            ['week_day_id' => 5, 'lesson_order_id' => 4, 'department_id' => 2,
                'start_time' => '13:20:00', 'end_time' => '14:40:00', 'break' => 10, 'code' => $this->code()],
            ['week_day_id' => 5, 'lesson_order_id' => 5, 'department_id' => 2,
                'start_time' => '14:50:00', 'end_time' => '16:10:00', 'break' => 25, 'code' => $this->code()],
            ['week_day_id' => 5, 'lesson_order_id' => 6, 'department_id' => 2,
                'start_time' => '16:35:00', 'end_time' => '17:55:00', 'break' => 10, 'code' => $this->code()],
            ['week_day_id' => 5, 'lesson_order_id' => 7, 'department_id' => 2,
                'start_time' => '18:05:00', 'end_time' => '19:25:00', 'break' => 0, 'code' => $this->code()],

            ['week_day_id' => 6, 'lesson_order_id' => 1, 'department_id' => 2,
                'start_time' => '08:30:00', 'end_time' => '09:50:00', 'break' => 5, 'code' => $this->code()],
            ['week_day_id' => 6, 'lesson_order_id' => 2, 'department_id' => 2,
                'start_time' => '09:55:00', 'end_time' => '11:15:00', 'break' => 30, 'code' => $this->code()],
            ['week_day_id' => 6, 'lesson_order_id' => 3, 'department_id' => 2,
                'start_time' => '11:45:00', 'end_time' => '13:05:00', 'break' => 10, 'code' => $this->code()],
            ['week_day_id' => 6, 'lesson_order_id' => 4, 'department_id' => 2,
                'start_time' => '13:15:00', 'end_time' => '14:35:00', 'break' => 0, 'code' => $this->code()],
        ];

        DB::table('departments')->insert($departments);
        DB::table('groups')->insert($groups);
        DB::table('roles')->insert($roles);
        DB::table('users')->insert($users);
        DB::table('audiences')->insert($audiences);
        DB::table('groups_parts')->insert($groupPart);
        DB::table('lessons_orders')->insert($lessonOrd);
        DB::table('subjects')->insert($subjects);
        DB::table('week_days')->insert($weeks);
        DB::table('schedules')->insert($schedules);
        DB::table('teachers')->insert($teachers);
        DB::table('group_captains')->insert($starosts);
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
