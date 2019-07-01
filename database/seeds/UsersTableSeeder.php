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
        //

        App\User::create([
          'name' => 'Admin',
          'prenom' => 'Admin',
          'email' => 'admin',
          'password' => bcrypt('password'),
          'niveau' => 2
        ]);

    }
}
