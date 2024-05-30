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
        DB::table('administrators')->insert([
            [
                'name' => 'Admin2',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
            ]
        ]);



        DB::table('users')->insert([
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => bcrypt('password'),
            ]
        ]);

        DB::table('teachers')->insert([
            [
                'id' => '1',
                'name' => 'Vu',
                'email' => 'vu@gmail.com',
                'profile' => '',
                'birthday' => '2001/10/10',
                'image' => '',
                'gender' => '1',
                'phone' => '0999999999',
                'password' => bcrypt('password'),
            ],
            [
                'id' => '2',
                'name' => 'a',
                'email' => 'teacherA@gmail.com',
                'profile' => '',
                'birthday' => '2001/10/10',
                'image' => '',
                'gender' => '1',
                'phone' => '0999999999',
                'password' => bcrypt('password'),
            ],
            [
                'id' => '3',
                'name' => 'b',
                'email' => 'teacherB@gmail.com',
                'profile' => '',
                'birthday' => '2001/10/10',
                'image' => '',
                'gender' => '1',
                'phone' => '0999999999',
                'password' => bcrypt('password'),
            ],
            [
                'id' => '4',
                'name' => 'C',
                'email' => 'teacherC@gmail.com',
                'profile' => '',
                'birthday' => '2001/10/10',
                'image' => '',
                'gender' => '1',
                'phone' => '0999999999',
                'password' => bcrypt('password'),
            ],
            [
                'id' => '11',
                'name' => 'a Quynh',
                'email' => 'teacher@gmail.com',
                'profile' => '',
                'birthday' => '2001/10/10',
                'image' => '',
                'gender' => '1',
                'phone' => '0999999999',
                'password' => bcrypt('password'),
            ]
        ]);

        DB::table('questions')->insert([
            [
                'teacher_id' => '11',
                'description' => 'Fill in the blank',
                'options' => '{"A":"123","B":"232","C":"12","D":"412"}',
                'results' => 'C',
            ],
            [
                'teacher_id' => '11',
                'description' => 'Fill in the blank: 1+1 = ...',
                'options' => '{"A":"123","B":"232","C":"12","D":"412"}',
                'results' => 'B',
            ],
            [
                'teacher_id' => '11',
                'description' => 'Quest 3: 1+1 = ...',
                'options' => '{"A":"123","B":"232","C":"12","D":"412"}',
                'results' => 'A',
            ],
        ]);



        DB::table('lessons')->insert([
            [
                'lesson_name' => 'Math',
                'question_list' => '["1","2","3"]',
                'video' => '<iframe src="https://docs.google.com/presentation/d/e/2PACX-1vRayBaIsVDj2Cqt9IHy74b6eVj4E4bKIlBJxOcwUyq56Nk4uFH3ZXJp3_0785wEYQ/embed?start=false&loop=false&delayms=3000" frameborder="0" width="1280" height="749" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>',
                'teacher_id' => '11',
            ],
        ]);
    }
}
