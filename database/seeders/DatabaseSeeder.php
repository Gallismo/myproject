<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            ['id' => 3, 'name' => 'Староста'],
        ];

        $groups = [
            [
                'name' => 'И-19-19',
                'department_id' => '2',
                'start_year' => 2019,
                'end_year' => 2023
            ]
        ];

        $users = [
            [
                'id' => 1, 'login' => 'sperecur', 'name' => 'Администратор',
                'password' => Hash::make('123456'), 'role_id' => '1', 'group_id' => null,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2, 'name' => 'Иванов Иван Иванович', 'login' => 'prepod',
                'password' => Hash::make('123456'), 'role_id' => '2', 'group_id' => null,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')
            ],[
                'id' => 3, 'name' => 'Галилов Гоша', 'login' => 'starosta',
                'password' => Hash::make('123456'), 'role_id' => '3', 'group_id' => '1',
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')
            ],
        ];

        $departments = [
            ['id' => 1, 'name' => 'Технологическое'],
            ['id' => 2, 'name' => 'Экономическое'],
            ['id' => 3, 'name' => 'Дистанционное обучение'],
        ];

        $audiences = [
            ['id' => 1, 'name' => '30'],
            ['id' => 2, 'name' => '31'],
            ['id' => 3, 'name' => '32'],
            ['id' => 4, 'name' => '33'],
            ['id' => 5, 'name' => '34'],
            ['id' => 6, 'name' => '35'],
            ['id' => 7, 'name' => '36'],
            ['id' => 8, 'name' => '37'],
            ['id' => 9, 'name' => '38'],
            ['id' => 10, 'name' => 'Спортивный зал'],
        ];

        $groupPart = [
            ['id' => 1, 'name' => 'Вся группа'],
            ['id' => 2, 'name' => 'Первая подгруппа'],
            ['id' => 3, 'name' => 'Вторая подгруппа'],
        ];

        $lessonOrd = [
            ['id' => 1, 'name' => '1 пара'],
            ['id' => 2, 'name' => '2 пара'],
            ['id' => 3, 'name' => '3 пара'],
            ['id' => 4, 'name' => '4 пара'],
            ['id' => 5, 'name' => '5 пара'],
            ['id' => 6, 'name' => '6 пара'],
            ['id' => 7, 'name' => '7 пара'],
            ['id' => 8, 'name' => 'Классный час'],
        ];

        $subjects = [
            ['id' => 1, 'name' => 'Математика'],
            ['id' => 2, 'name' => 'МДК'],
            ['id' => 3, 'name' => 'Спец рисунок'],
            ['id' => 4, 'name' => 'Физра'],
            ['id' => 5, 'name' => 'Ботаника'],
            ['id' => 6, 'name' => 'Физика'],
            ['id' => 7, 'name' => 'Граф дизайн']
        ];

        $weeks = [
            ['id' => 1, 'name' => 'Понедельник'],
            ['id' => 2, 'name' => 'Вторник'],
            ['id' => 3, 'name' => 'Среда'],
            ['id' => 4, 'name' => 'Четверг'],
            ['id' => 5, 'name' => 'Пятница'],
            ['id' => 6, 'name' => 'Суббота'],
            ['id' => 7, 'name' => 'Воскресенье'],
        ];

        $schedules = [
//            poned Tech
            ['week_day_id' => 1, 'lesson_order_id' => 1, 'department_id' => 1,
                'start_time' => '08:45:00', 'end_time' => '10:05:00', 'break' => 10],
            ['week_day_id' => 1, 'lesson_order_id' => 2, 'department_id' => 1,
                'start_time' => '10:15:00', 'end_time' => '11:35:00', 'break' => 15],
            ['week_day_id' => 1, 'lesson_order_id' => 3, 'department_id' => 1,
                'start_time' => '11:50:00', 'end_time' => '13:10:00', 'break' => 45],
            ['week_day_id' => 1, 'lesson_order_id' => 4, 'department_id' => 1,
                'start_time' => '13:55:00', 'end_time' => '15:15:00', 'break' => 5],
            ['week_day_id' => 1, 'lesson_order_id' => 5, 'department_id' => 1,
                'start_time' => '15:20:00', 'end_time' => '16:40:00', 'break' => 20],
            ['week_day_id' => 1, 'lesson_order_id' => 6, 'department_id' => 1,
                'start_time' => '17:00:00', 'end_time' => '18:20:00', 'break' => 5],
            ['week_day_id' => 1, 'lesson_order_id' => 7, 'department_id' => 1,
                'start_time' => '18:25:00', 'end_time' => '19:45:00', 'break' => 0],

            ['week_day_id' => 2, 'lesson_order_id' => 1, 'department_id' => 1,
                'start_time' => '08:45:00', 'end_time' => '10:05:00', 'break' => 10],
            ['week_day_id' => 2, 'lesson_order_id' => 2, 'department_id' => 1,
                'start_time' => '10:15:00', 'end_time' => '11:35:00', 'break' => 15],
            ['week_day_id' => 2, 'lesson_order_id' => 3, 'department_id' => 1,
                'start_time' => '11:50:00', 'end_time' => '13:10:00', 'break' => 5],
            ['week_day_id' => 2, 'lesson_order_id' => 8, 'department_id' => 1,
                'start_time' => '13:15:00', 'end_time' => '13:55:00', 'break' => 40],
            ['week_day_id' => 2, 'lesson_order_id' => 4, 'department_id' => 1,
                'start_time' => '14:35:00', 'end_time' => '15:55:00', 'break' => 5],
            ['week_day_id' => 2, 'lesson_order_id' => 5, 'department_id' => 1,
                'start_time' => '16:00:00', 'end_time' => '17:20:00', 'break' => 15],
            ['week_day_id' => 2, 'lesson_order_id' => 6, 'department_id' => 1,
                'start_time' => '17:35:00', 'end_time' => '18:55:00', 'break' => 0],
//            sreda Tech
            ['week_day_id' => 3, 'lesson_order_id' => 1, 'department_id' => 1,
                'start_time' => '08:45:00', 'end_time' => '10:05:00', 'break' => 10],
            ['week_day_id' => 3, 'lesson_order_id' => 2, 'department_id' => 1,
                'start_time' => '10:15:00', 'end_time' => '11:35:00', 'break' => 15],
            ['week_day_id' => 3, 'lesson_order_id' => 3, 'department_id' => 1,
                'start_time' => '11:50:00', 'end_time' => '13:10:00', 'break' => 45],
            ['week_day_id' => 3, 'lesson_order_id' => 4, 'department_id' => 1,
                'start_time' => '13:55:00', 'end_time' => '15:15:00', 'break' => 5],
            ['week_day_id' => 3, 'lesson_order_id' => 5, 'department_id' => 1,
                'start_time' => '15:20:00', 'end_time' => '16:40:00', 'break' => 20],
            ['week_day_id' => 3, 'lesson_order_id' => 6, 'department_id' => 1,
                'start_time' => '17:00:00', 'end_time' => '18:20:00', 'break' => 5],
            ['week_day_id' => 3, 'lesson_order_id' => 7, 'department_id' => 1,
                'start_time' => '18:25:00', 'end_time' => '19:45:00', 'break' => 0],
//            Chet Tech
            ['week_day_id' => 4, 'lesson_order_id' => 1, 'department_id' => 1,
                'start_time' => '08:45:00', 'end_time' => '10:05:00', 'break' => 10],
            ['week_day_id' => 4, 'lesson_order_id' => 2, 'department_id' => 1,
                'start_time' => '10:15:00', 'end_time' => '11:35:00', 'break' => 15],
            ['week_day_id' => 4, 'lesson_order_id' => 3, 'department_id' => 1,
                'start_time' => '11:50:00', 'end_time' => '13:10:00', 'break' => 45],
            ['week_day_id' => 4, 'lesson_order_id' => 4, 'department_id' => 1,
                'start_time' => '13:55:00', 'end_time' => '15:15:00', 'break' => 5],
            ['week_day_id' => 4, 'lesson_order_id' => 5, 'department_id' => 1,
                'start_time' => '15:20:00', 'end_time' => '16:40:00', 'break' => 20],
            ['week_day_id' => 4, 'lesson_order_id' => 6, 'department_id' => 1,
                'start_time' => '17:00:00', 'end_time' => '18:20:00', 'break' => 5],
            ['week_day_id' => 4, 'lesson_order_id' => 7, 'department_id' => 1,
                'start_time' => '18:25:00', 'end_time' => '19:45:00', 'break' => 0],
//            Pt Tech
            ['week_day_id' => 5, 'lesson_order_id' => 1, 'department_id' => 1,
                'start_time' => '08:45:00', 'end_time' => '10:05:00', 'break' => 10],
            ['week_day_id' => 5, 'lesson_order_id' => 2, 'department_id' => 1,
                'start_time' => '10:15:00', 'end_time' => '11:35:00', 'break' => 15],
            ['week_day_id' => 5, 'lesson_order_id' => 3, 'department_id' => 1,
                'start_time' => '11:50:00', 'end_time' => '13:10:00', 'break' => 45],
            ['week_day_id' => 5, 'lesson_order_id' => 4, 'department_id' => 1,
                'start_time' => '13:55:00', 'end_time' => '15:15:00', 'break' => 5],
            ['week_day_id' => 5, 'lesson_order_id' => 5, 'department_id' => 1,
                'start_time' => '15:20:00', 'end_time' => '16:40:00', 'break' => 20],
            ['week_day_id' => 5, 'lesson_order_id' => 6, 'department_id' => 1,
                'start_time' => '17:00:00', 'end_time' => '18:20:00', 'break' => 5],
            ['week_day_id' => 5, 'lesson_order_id' => 7, 'department_id' => 1,
                'start_time' => '18:25:00', 'end_time' => '19:45:00', 'break' => 0],

            ['week_day_id' => 6, 'lesson_order_id' => 1, 'department_id' => 1,
                'start_time' => '08:45:00', 'end_time' => '10:05:00', 'break' => 10],
            ['week_day_id' => 6, 'lesson_order_id' => 2, 'department_id' => 1,
                'start_time' => '10:15:00', 'end_time' => '11:35:00', 'break' => 30],
            ['week_day_id' => 6, 'lesson_order_id' => 3, 'department_id' => 1,
                'start_time' => '12:05:00', 'end_time' => '13:25:00', 'break' => 5],
            ['week_day_id' => 6, 'lesson_order_id' => 4, 'department_id' => 1,
                'start_time' => '13:30:00', 'end_time' => '14:50:00', 'break' => 0],

            ['week_day_id' => 1, 'lesson_order_id' => 1, 'department_id' => 2,
                'start_time' => '08:30:00', 'end_time' => '09:50:00', 'break' => 5],
            ['week_day_id' => 1, 'lesson_order_id' => 2, 'department_id' => 2,
                'start_time' => '09:55:00', 'end_time' => '11:15:00', 'break' => 5],
            ['week_day_id' => 1, 'lesson_order_id' => 3, 'department_id' => 2,
                'start_time' => '11:20:00', 'end_time' => '12:40:00', 'break' => 40],
            ['week_day_id' => 1, 'lesson_order_id' => 4, 'department_id' => 2,
                'start_time' => '13:20:00', 'end_time' => '14:40:00', 'break' => 10],
            ['week_day_id' => 1, 'lesson_order_id' => 5, 'department_id' => 2,
                'start_time' => '14:50:00', 'end_time' => '16:10:00', 'break' => 25],
            ['week_day_id' => 1, 'lesson_order_id' => 6, 'department_id' => 2,
                'start_time' => '16:35:00', 'end_time' => '17:55:00', 'break' => 10],
            ['week_day_id' => 1, 'lesson_order_id' => 7, 'department_id' => 2,
                'start_time' => '18:05:00', 'end_time' => '19:25:00', 'break' => 0],

            ['week_day_id' => 2, 'lesson_order_id' => 1, 'department_id' => 2,
                'start_time' => '08:30:00', 'end_time' => '09:50:00', 'break' => 5],
            ['week_day_id' => 2, 'lesson_order_id' => 2, 'department_id' => 2,
                'start_time' => '09:55:00', 'end_time' => '11:15:00', 'break' => 5],
            ['week_day_id' => 2, 'lesson_order_id' => 3, 'department_id' => 2,
                'start_time' => '11:20:00', 'end_time' => '12:40:00', 'break' => 40],
            ['week_day_id' => 2, 'lesson_order_id' => 8, 'department_id' => 2,
                'start_time' => '13:20:00', 'end_time' => '14:00:00', 'break' => 0],
            ['week_day_id' => 2, 'lesson_order_id' => 4, 'department_id' => 2,
                'start_time' => '14:00:00', 'end_time' => '15:20:00', 'break' => 10],
            ['week_day_id' => 2, 'lesson_order_id' => 5, 'department_id' => 2,
                'start_time' => '15:30:00', 'end_time' => '16:50:00', 'break' => 25],
            ['week_day_id' => 2, 'lesson_order_id' => 6, 'department_id' => 2,
                'start_time' => '17:15:00', 'end_time' => '18:35:00', 'break' => 0],

            ['week_day_id' => 3, 'lesson_order_id' => 1, 'department_id' => 2,
                'start_time' => '08:30:00', 'end_time' => '09:50:00', 'break' => 5],
            ['week_day_id' => 3, 'lesson_order_id' => 2, 'department_id' => 2,
                'start_time' => '09:55:00', 'end_time' => '11:15:00', 'break' => 5],
            ['week_day_id' => 3, 'lesson_order_id' => 3, 'department_id' => 2,
                'start_time' => '11:20:00', 'end_time' => '12:40:00', 'break' => 40],
            ['week_day_id' => 3, 'lesson_order_id' => 4, 'department_id' => 2,
                'start_time' => '13:20:00', 'end_time' => '14:40:00', 'break' => 10],
            ['week_day_id' => 3, 'lesson_order_id' => 5, 'department_id' => 2,
                'start_time' => '14:50:00', 'end_time' => '16:10:00', 'break' => 25],
            ['week_day_id' => 3, 'lesson_order_id' => 6, 'department_id' => 2,
                'start_time' => '16:35:00', 'end_time' => '17:55:00', 'break' => 10],
            ['week_day_id' => 3, 'lesson_order_id' => 7, 'department_id' => 2,
                'start_time' => '18:05:00', 'end_time' => '19:25:00', 'break' => 0],

            ['week_day_id' => 4, 'lesson_order_id' => 1, 'department_id' => 2,
                'start_time' => '08:30:00', 'end_time' => '09:50:00', 'break' => 5],
            ['week_day_id' => 4, 'lesson_order_id' => 2, 'department_id' => 2,
                'start_time' => '09:55:00', 'end_time' => '11:15:00', 'break' => 5],
            ['week_day_id' => 4, 'lesson_order_id' => 3, 'department_id' => 2,
                'start_time' => '11:20:00', 'end_time' => '12:40:00', 'break' => 40],
            ['week_day_id' => 4, 'lesson_order_id' => 4, 'department_id' => 2,
                'start_time' => '13:20:00', 'end_time' => '14:40:00', 'break' => 10],
            ['week_day_id' => 4, 'lesson_order_id' => 5, 'department_id' => 2,
                'start_time' => '14:50:00', 'end_time' => '16:10:00', 'break' => 25],
            ['week_day_id' => 4, 'lesson_order_id' => 6, 'department_id' => 2,
                'start_time' => '16:35:00', 'end_time' => '17:55:00', 'break' => 10],
            ['week_day_id' => 4, 'lesson_order_id' => 7, 'department_id' => 2,
                'start_time' => '18:05:00', 'end_time' => '19:25:00', 'break' => 0],

            ['week_day_id' => 5, 'lesson_order_id' => 1, 'department_id' => 2,
                'start_time' => '08:30:00', 'end_time' => '09:50:00', 'break' => 5],
            ['week_day_id' => 5, 'lesson_order_id' => 2, 'department_id' => 2,
                'start_time' => '09:55:00', 'end_time' => '11:15:00', 'break' => 5],
            ['week_day_id' => 5, 'lesson_order_id' => 3, 'department_id' => 2,
                'start_time' => '11:20:00', 'end_time' => '12:40:00', 'break' => 40],
            ['week_day_id' => 5, 'lesson_order_id' => 4, 'department_id' => 2,
                'start_time' => '13:20:00', 'end_time' => '14:40:00', 'break' => 10],
            ['week_day_id' => 5, 'lesson_order_id' => 5, 'department_id' => 2,
                'start_time' => '14:50:00', 'end_time' => '16:10:00', 'break' => 25],
            ['week_day_id' => 5, 'lesson_order_id' => 6, 'department_id' => 2,
                'start_time' => '16:35:00', 'end_time' => '17:55:00', 'break' => 10],
            ['week_day_id' => 5, 'lesson_order_id' => 7, 'department_id' => 2,
                'start_time' => '18:05:00', 'end_time' => '19:25:00', 'break' => 0],

            ['week_day_id' => 6, 'lesson_order_id' => 1, 'department_id' => 2,
                'start_time' => '08:30:00', 'end_time' => '09:50:00', 'break' => 5],
            ['week_day_id' => 6, 'lesson_order_id' => 2, 'department_id' => 2,
                'start_time' => '09:55:00', 'end_time' => '11:15:00', 'break' => 30],
            ['week_day_id' => 6, 'lesson_order_id' => 3, 'department_id' => 2,
                'start_time' => '11:45:00', 'end_time' => '13:05:00', 'break' => 10],
            ['week_day_id' => 6, 'lesson_order_id' => 4, 'department_id' => 2,
                'start_time' => '13:15:00', 'end_time' => '14:35:00', 'break' => 0],

            ['week_day_id' => 1, 'lesson_order_id' => 1, 'department_id' => 3,
                'start_time' => '09:00:00', 'end_time' => '09:45:00', 'break' => 10],
            ['week_day_id' => 1, 'lesson_order_id' => 2, 'department_id' => 3,
                'start_time' => '09:55:00', 'end_time' => '10:40:00', 'break' => 10],
            ['week_day_id' => 1, 'lesson_order_id' => 3, 'department_id' => 3,
                'start_time' => '10:50:00', 'end_time' => '11:35:00', 'break' => 25],
            ['week_day_id' => 1, 'lesson_order_id' => 4, 'department_id' => 3,
                'start_time' => '12:00:00', 'end_time' => '12:45:00', 'break' => 10],
            ['week_day_id' => 1, 'lesson_order_id' => 5, 'department_id' => 3,
                'start_time' => '12:55:00', 'end_time' => '13:40:00', 'break' => 5],
            ['week_day_id' => 1, 'lesson_order_id' => 6, 'department_id' => 3,
                'start_time' => '13:45:00', 'end_time' => '14:30:00', 'break' => 5],
            ['week_day_id' => 1, 'lesson_order_id' => 7, 'department_id' => 3,
                'start_time' => '14:35:00', 'end_time' => '15:20:00', 'break' => 0],

            ['week_day_id' => 2, 'lesson_order_id' => 1, 'department_id' => 3,
                'start_time' => '09:00:00', 'end_time' => '09:45:00', 'break' => 10],
            ['week_day_id' => 2, 'lesson_order_id' => 2, 'department_id' => 3,
                'start_time' => '09:55:00', 'end_time' => '10:40:00', 'break' => 10],
            ['week_day_id' => 2, 'lesson_order_id' => 3, 'department_id' => 3,
                'start_time' => '10:50:00', 'end_time' => '11:35:00', 'break' => 25],
            ['week_day_id' => 2, 'lesson_order_id' => 4, 'department_id' => 3,
                'start_time' => '12:00:00', 'end_time' => '12:45:00', 'break' => 10],
            ['week_day_id' => 2, 'lesson_order_id' => 5, 'department_id' => 3,
                'start_time' => '12:55:00', 'end_time' => '13:40:00', 'break' => 5],
            ['week_day_id' => 2, 'lesson_order_id' => 6, 'department_id' => 3,
                'start_time' => '13:45:00', 'end_time' => '14:30:00', 'break' => 5],
            ['week_day_id' => 2, 'lesson_order_id' => 7, 'department_id' => 3,
                'start_time' => '14:35:00', 'end_time' => '15:20:00', 'break' => 0],

            ['week_day_id' => 3, 'lesson_order_id' => 1, 'department_id' => 3,
                'start_time' => '09:00:00', 'end_time' => '09:45:00', 'break' => 10],
            ['week_day_id' => 3, 'lesson_order_id' => 2, 'department_id' => 3,
                'start_time' => '09:55:00', 'end_time' => '10:40:00', 'break' => 10],
            ['week_day_id' => 3, 'lesson_order_id' => 3, 'department_id' => 3,
                'start_time' => '10:50:00', 'end_time' => '11:35:00', 'break' => 25],
            ['week_day_id' => 3, 'lesson_order_id' => 4, 'department_id' => 3,
                'start_time' => '12:00:00', 'end_time' => '12:45:00', 'break' => 10],
            ['week_day_id' => 3, 'lesson_order_id' => 5, 'department_id' => 3,
                'start_time' => '12:55:00', 'end_time' => '13:40:00', 'break' => 5],
            ['week_day_id' => 3, 'lesson_order_id' => 6, 'department_id' => 3,
                'start_time' => '13:45:00', 'end_time' => '14:30:00', 'break' => 5],
            ['week_day_id' => 3, 'lesson_order_id' => 7, 'department_id' => 3,
                'start_time' => '14:35:00', 'end_time' => '15:20:00', 'break' => 0],

            ['week_day_id' => 4, 'lesson_order_id' => 1, 'department_id' => 3,
                'start_time' => '09:00:00', 'end_time' => '09:45:00', 'break' => 10],
            ['week_day_id' => 4, 'lesson_order_id' => 2, 'department_id' => 3,
                'start_time' => '09:55:00', 'end_time' => '10:40:00', 'break' => 10],
            ['week_day_id' => 4, 'lesson_order_id' => 3, 'department_id' => 3,
                'start_time' => '10:50:00', 'end_time' => '11:35:00', 'break' => 25],
            ['week_day_id' => 4, 'lesson_order_id' => 4, 'department_id' => 3,
                'start_time' => '12:00:00', 'end_time' => '12:45:00', 'break' => 10],
            ['week_day_id' => 4, 'lesson_order_id' => 5, 'department_id' => 3,
                'start_time' => '12:55:00', 'end_time' => '13:40:00', 'break' => 5],
            ['week_day_id' => 4, 'lesson_order_id' => 6, 'department_id' => 3,
                'start_time' => '13:45:00', 'end_time' => '14:30:00', 'break' => 5],
            ['week_day_id' => 4, 'lesson_order_id' => 7, 'department_id' => 3,
                'start_time' => '14:35:00', 'end_time' => '15:20:00', 'break' => 0],

            ['week_day_id' => 5, 'lesson_order_id' => 1, 'department_id' => 3,
                'start_time' => '09:00:00', 'end_time' => '09:45:00', 'break' => 10],
            ['week_day_id' => 5, 'lesson_order_id' => 2, 'department_id' => 3,
                'start_time' => '09:55:00', 'end_time' => '10:40:00', 'break' => 10],
            ['week_day_id' => 5, 'lesson_order_id' => 3, 'department_id' => 3,
                'start_time' => '10:50:00', 'end_time' => '11:35:00', 'break' => 25],
            ['week_day_id' => 5, 'lesson_order_id' => 4, 'department_id' => 3,
                'start_time' => '12:00:00', 'end_time' => '12:45:00', 'break' => 10],
            ['week_day_id' => 5, 'lesson_order_id' => 5, 'department_id' => 3,
                'start_time' => '12:55:00', 'end_time' => '13:40:00', 'break' => 5],
            ['week_day_id' => 5, 'lesson_order_id' => 6, 'department_id' => 3,
                'start_time' => '13:45:00', 'end_time' => '14:30:00', 'break' => 5],
            ['week_day_id' => 5, 'lesson_order_id' => 7, 'department_id' => 3,
                'start_time' => '14:35:00', 'end_time' => '15:20:00', 'break' => 0],

            ['week_day_id' => 6, 'lesson_order_id' => 1, 'department_id' => 3,
                'start_time' => '09:00:00', 'end_time' => '09:45:00', 'break' => 10],
            ['week_day_id' => 6, 'lesson_order_id' => 2, 'department_id' => 3,
                'start_time' => '09:55:00', 'end_time' => '10:40:00', 'break' => 10],
            ['week_day_id' => 6, 'lesson_order_id' => 3, 'department_id' => 3,
                'start_time' => '10:50:00', 'end_time' => '11:35:00', 'break' => 25],
            ['week_day_id' => 6, 'lesson_order_id' => 4, 'department_id' => 3,
                'start_time' => '12:00:00', 'end_time' => '12:45:00', 'break' => 0],
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
    }
}
