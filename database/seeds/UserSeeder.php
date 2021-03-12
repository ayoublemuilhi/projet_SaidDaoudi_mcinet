<?php

use Illuminate\Database\Seeder;
use \App\User;
use \App\Models\Role;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'sys',
            'email' => 'ayoub@gmail.com',
            'password' => bcrypt('12345678'),
            'status' => 1,
            'image' => ''
        ]);

        $role = Role::create(['name' => 'sys']);

        $user->assignRole([$role->id]);


    }
}
