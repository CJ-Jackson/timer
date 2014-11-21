<?php

class UserTableSeeder extends Seeder {

	public function run() {
		DB::table("users")->delete();
		User::create(array(
			"username" => "cjjackson",
			"password" => Hash::make("password"),
			"email" => "hello@cj-jackson.com",
		));
	}

}