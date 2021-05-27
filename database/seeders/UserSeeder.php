<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')
            ->insert(array(
                array(
                    'name'              => 'test.user',
                    'email'             => 'test.user@mail.com',
                    'email_verified_at' => '2021-03-19 12:00:00',
                    'password'          => Hash::make('password')
                )
            ));
    }
}
