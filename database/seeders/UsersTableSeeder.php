<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => env('INITIAL_USER_NAME'),
            'email' => env('INITIAL_USER_EMAIL'),
            'password' => app('hash')->make(env('INITIAL_USER_PASSWORD')),
        ]);
    }
}
