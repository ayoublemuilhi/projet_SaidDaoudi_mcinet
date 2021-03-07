<?php

use Illuminate\Database\Seeder;
use \App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =
          ['name' => 'admin','email' => 'admin@gmail.com','password' => bcrypt(123),
              'status' => 1,'image' => ''
          ];

        User::create($user);
    }
}
