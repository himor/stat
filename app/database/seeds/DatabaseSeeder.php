<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        /**
         * Insert user
         */

        $hashed = Hash::make('qwerty');

        DB::table('users')->insert(
            array(
                'email'    => 'himor.cre@gmail.com',
                'password' => $hashed
            )
        );



	}

}