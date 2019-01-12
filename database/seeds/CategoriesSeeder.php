<?php

use Illuminate\Database\Seeder;
use App\Category;
class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
			'name' => 'Materia Prima',
		]);
		Category::create([
			'name' => 'Empaquetado',
		]);
		Category::create([
			'name' => 'Producto Terminado',
		]);
        Category::create([
            'name' => 'Materia Producida',
        ]);
    }
}
