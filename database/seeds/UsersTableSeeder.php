<?php

use Illuminate\Database\Seeder;
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
        	'name'   => 'Trí Đỗ Viết',
        	'email'   => 'tri.dv270999@gmail.com',
         	'password' => Hash::make('tri'),
        	'ruler'  => 1
        ]);
    }
}
