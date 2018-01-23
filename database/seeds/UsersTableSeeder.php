<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      =>  'Administrador',
            'email'     =>  'admin@admin.com',
            'password'  =>  bcrypt('123456'),
            'role_id'   =>  1

        ]);

        User::create([
            'name'      =>  'Usuario',
            'email'     =>  'user@user.com',
            'password'  =>  bcrypt('123456'),
            'role_id'   =>  2

        ]);
    }
}
