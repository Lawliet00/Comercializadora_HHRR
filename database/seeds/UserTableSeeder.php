<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'Administrador',
        	// 'auth' => 1,
        	// 'status' => 'active',
        	'level' => 1,
        	// 'chat_client' => 1,
        	'email' => "admin@admin.com",
        	'password' => bcrypt("password")
		]);
    }
}
