<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {

        DB::table('users')->insert([

            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$q4RcwRhxKiQgZGtdGRtZ3e/RYW983p39bZ0dlJV43I3rjm1OKPMei',
                'remember_token' => null,
            ],
            [
                'id'             => 2,
                'name'           => 'Mark',
                'email'          => 'mark@mark.com',
                'password'       => '$2y$10$q4RcwRhxKiQgZGtdGRtZ3e/RYW983p39bZ0dlJV43I3rjm1OKPMei',
                'remember_token' => null,
            ],
            [
                'id'             => 3,
                'name'           => 'Juliet',
                'email'          => 'juliet@juliet.com',
                'password'       => '$2y$10$q4RcwRhxKiQgZGtdGRtZ3e/RYW983p39bZ0dlJV43I3rjm1OKPMei',
                'remember_token' => null,
            ]

        ]);

    }
}
