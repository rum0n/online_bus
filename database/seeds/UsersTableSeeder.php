<?php

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
         	'role_id'=>'1',
        	'name' => 'Admin',
        	'email' => 'admin@gmail.com',
            'phone_number' => '+8801750045866',
        	'password' => bcrypt('12345678'),
        ]);

		DB::table('users')->insert([
			'role_id'=>'2',
			'name' => 'User',
			'email' => 'user@gmail.com',
            'phone_number' => '+8801750045861',
			'password' => bcrypt('12345678'),
		]);
    }
}
