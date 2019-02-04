<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Inventory;
use App\Formula;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Product::create([
        	'category_id' => 3,
			'name' => 'Aliño 100gr',
			'peso_unit' => '0.100',
			'price' => 1000,
			'quantity_for_box' => 40,
			'medida' => 'Unidades',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 1,
			'quantity' => 39,
			'stock_min' => 100,
		]);


		Product::create([
			'category_id' => 3,
			'name' => 'Aliño 200gr',
			'peso_unit' => '0.200',
			'price' => 1000,
			'quantity_for_box' => 30,
			'medida' => 'Unidades',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 2,
			'quantity' => 50,
			'stock_min' => null,
		]);




		Product::create([
			'category_id' => 3,
			'name' => 'Aliño 400gr',
			'peso_unit' => '0.400',
			'price' => 1000,
			'quantity_for_box' => 30,
			'medida' => 'Unidades',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 3,
			'quantity' => 400,
			'stock_min' => 100,
		]);


		Product::create([
			'category_id' => 3,
			'name' => 'Aliño 800gr',
			'peso_unit' => '0.800',
			'price' => 1000,
			'quantity_for_box' => 20,
			'medida' => 'Unidades',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 4,
			'quantity' => 400,
			'stock_min' => 100,
		]);

		Product::create([
			'category_id' => 3,
			'name' => 'Aliño 45gr',
			'peso_unit' => '0.045',
			'price' => 1000,
			'quantity_for_box' => 10,
			'medida' => 'Unidades',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 5,
			'quantity' => 400,
			'stock_min' => 100,
		]);

		Product::create([
			'category_id' => 3,
			'name' => 'Aliño 90gr',
			'peso_unit' => '0.090',
			'price' => 1000,
			'quantity_for_box' => 10,
			'medida' => 'Unidades',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 6,
			'quantity' => 400,
			'stock_min' => 100,
		]);

		Product::create([
			'category_id' => 3,
			'name' => 'Aliño 14gr',
			'peso_unit' => '0.014',
			'price' => 1000,
			'quantity_for_box' => 10,
			'medida' => 'Unidades',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 7,
			'quantity' => 400,
			'stock_min' => 100,
		]);

		Product::create([
			'category_id' => 1,
			'name' => 'Maiz',
			'price' => 3000,
			'medida' => 'Kg',
			'quantity_for_box' => 20,
		]);
		Inventory::create([
			'product_id' => 8,
			'Kg_L' => 400.00,
			'stock_min' => 100,
			// 'type_stock_min' => 'Kg_L',
		]);

		Product::create([
			'category_id' => 1,
			'name' => 'Arina Maiz',
			'price' => 3000,
			'medida' => 'Kg',
			'quantity_for_box' => 20,
		]);
		Inventory::create([
			'product_id' => 9,
			// 'type_stock_min' => 'Kg_L',
			'Kg_L' => 400.00,
			'stock_min' => 100,
		]);

		Product::create([
			'category_id' => 1,
			'name' => 'Aceite',
			'price' => 3000,
			'medida' => 'L',
			'quantity_for_box' => 12,
		]);
		Inventory::create([
			'product_id' => 10,
			// 'type_stock_min' => 'Kg_L',
			'Kg_L' => 800.00,
			'stock_min' => 100,
		]);

		Product::create([
			'category_id' => 1,
			'name' => 'Achote grano',
			'price' => 3000,
			'medida' => 'Kg',
			'quantity_for_box' => 20,
		]);
		Inventory::create([
			'product_id' => 11,
			// 'type_stock_min' => 'Kg_L',
			'Kg_L' => 200.00,
			'stock_min' => 100,
		]);

		Product::create([
        	'category_id' => 2,
			'name' => 'Aliño',
			'peso_unit' => '0.01',
			'price' => 1000,
			'quantity_for_box' => null,
			'medida' => 'Kg',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 12,
			// 'type_stock_min' => 'Kg_L',
			'Kg_L' => 1000,
			'stock_min' => '300',
		]);

		Formula::create([
			'product_id' => 12,
			'materia_prima' => 8,
		]);
		Formula::create([
			'product_id' => 12,
			'materia_prima' => 9,
		]);
		Formula::create([
			'product_id' => 12,
			'materia_prima' => 10,
		]);
		Formula::create([
			'product_id' => 12,
			'materia_prima' => 11,
		]);



		Product::create([
			'category_id' => 1,
			'name' => 'Bolsa 9x8',
			'peso_unit' => null,
			'price' => '1000',
			'quantity_for_box' => 100,
			'medida' => 'Unidades',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 13,
			'quantity' => 800,
			'stock_min' => 500,
		]);

		Product::create([
			'category_id' => 1,
			'name' => 'Etiquetas Aliño 100gr',
			'peso_unit' => null,
			'price' => 1000,
			'quantity_for_box' => 100,
			'medida' => 'Unidades',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 14,
			'quantity' => 800,
			'stock_min' => 500,
		]);
		Formula::create([
			'product_id' => 1,
			'materia_prima' => 12,
		]);
		Formula::create([
			'product_id' => 1,
			'materia_prima' => 13,
		]);
		Formula::create([
			'product_id' => 1,
			'materia_prima' => 14,
		]);


		Product::create([
			'category_id' => 1,
			'name' => 'Bolsa 9x24',
			'peso_unit' => null,
			'price' => 1000,
			'quantity_for_box' => 100,
			'medida' => 'Unidades',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 15,
			'quantity' => 800,
			'stock_min' => 500,
		]);

		Product::create([
        	'category_id' => 1,
			'name' => 'Etiquetas Aliño 200gr',
			'peso_unit' => null,
			'price' => 1000,
			'quantity_for_box' => 100,
			'medida' => 'Unidades',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 16,
			'quantity' => 800,
			'stock_min' => 500,
		]);
		Formula::create([
			'product_id' => 2,
			'materia_prima' => 12,
		]);
		Formula::create([
			'product_id' => 2,
			'materia_prima' => 15,
		]);
		Formula::create([
			'product_id' => 2,
			'materia_prima' => 16,
		]);


		Product::create([
			'category_id' => 1,
			'name' => 'Bolsa 1/2 para granos',
			'peso_unit' => null,
			'price' => 1000,
			'quantity_for_box' => 100,
			'medida' => 'Unidades',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 17,
			'quantity' => 800,
			'stock_min' => 500,
		]);

		Product::create([
        	'category_id' => 1,
			'name' => 'Etiquetas Aliño 400gr',
			'peso_unit' => null,
			'price' => 1000,
			'quantity_for_box' => 100,
			'medida' => 'Unidades',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 18,
			'quantity' => 800,
			'stock_min' => 500,
		]);
		Formula::create([
			'product_id' => 3,
			'materia_prima' => 12,
		]);
		Formula::create([
			'product_id' => 3,
			'materia_prima' => 17,
		]);
		Formula::create([
			'product_id' => 3,
			'materia_prima' => 18,
		]);



		Product::create([
			'category_id' => 1,
			'name' => 'Bolsa 1kg',
			'peso_unit' => null,
			'price' => 1000,
			'quantity_for_box' => 100,
			'medida' => 'Unidades',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 19,
			'quantity' => 800,
			'stock_min' => 500,
		]);

		Product::create([
        	'category_id' => 1,
			'name' => 'Etiquetas Aliño 800gr',
			'peso_unit' => null,
			'price' => 1000,
			'quantity_for_box' => 100,
			'medida' => 'Unidades',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 20,
			'quantity' => 800,
			'stock_min' => 500,
		]);
		Formula::create([
			'product_id' => 4,
			'materia_prima' => 12,
		]);
		Formula::create([
			'product_id' => 4,
			'materia_prima' => 19,
		]);
		Formula::create([
			'product_id' => 4,
			'materia_prima' => 20,
		]);


		Product::create([
        	'category_id' => 1,
			'name' => 'bolsas 9x15',
			'peso_unit' => null,
			'price' => 1000,
			'quantity_for_box' => 100,
			'medida' => 'Unidades',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 21,
			'quantity' => 800,
			'stock_min' => 500,
		]);
		Formula::create([
			'product_id' => 5,
			'materia_prima' => 12,
		]);
		Formula::create([
			'product_id' => 5,
			'materia_prima' => 21,
		]);



		Formula::create([
			'product_id' => 6,
			'materia_prima' => 12,
		]);
		Formula::create([
			'product_id' => 6,
			'materia_prima' => 21,
		]);


		Product::create([
        	'category_id' => 1,
			'name' => 'bolsas 7x10',
			'peso_unit' => null,
			'price' => 1000,
			'quantity_for_box' => 100,
			'medida' => 'Unidades',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 22,
			'quantity' => 800,
			'stock_min' => 500,
		]);
		Formula::create([
			'product_id' => 7,
			'materia_prima' => 12,
		]);
		Formula::create([
			'product_id' => 7,
			'materia_prima' => 22,
		]);





	}
}
