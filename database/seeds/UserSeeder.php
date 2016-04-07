<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table('users')->insert([
			'name' => 'Hasan Basri',
			'email' => 'hasanbasri2307@gmail.com',
			'role' => 'administrator',
			'password' => bcrypt("hasan"),
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:S")
		]);
    }
}
