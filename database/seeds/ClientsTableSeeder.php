<?php

use Illuminate\Database\Seeder;
use App\Client;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create([
			'code_rif' => 'J-1234123-4',
			'name_bussines' => 'Name Bussines',
			'name' => 'Name 1 Default',
			'address' => 'Av 1 N-123',
			'phone' => '+58 123 1234123',
			'email' => 'EmailTest@gmail.com',
			'tax' => 12,
		]);
		Client::create([
			'code_rif' => 'J-1234123-4',
			'name_bussines' => 'Name Bussines',
			'name' => 'Name 2 Default',
			'address' => 'Av 1 N-123',
			'phone' => '+58 123 1234123',
			'email' => 'EmailTest@gmail.com',
			'tax' => 12,
		]);
		Client::create([
			'code_rif' => 'J-1234123-4',
			'name_bussines' => 'Name Bussines',
			'name' => 'Name 3 Default',
			'address' => 'Av 1 N-123',
			'phone' => '+58 123 1234123',
			'email' => 'EmailTest@gmail.com',
			'tax' => 12,
		]);
		Client::create([
			'code_rif' => 'J-1234123-4',
			'name_bussines' => 'Name Bussines',
			'name' => 'Name 4 Default',
			'address' => 'Av 1 N-123',
			'phone' => '+58 123 1234123',
			'email' => 'EmailTest@gmail.com',
			'tax' => 12,
		]);
    }
}
