<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('users')->delete();
		App\User::create([
			'name' => 'manager',
			'email' => 'test@example.com',
			'password' => bcrypt('123456'),
		]);
	}
}
