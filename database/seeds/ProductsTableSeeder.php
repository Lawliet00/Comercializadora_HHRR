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
			'price' => '1000',
			'quantity_for_box' => '40',
			'medida' => 'Unidades',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 1,
			'quantity' => '39',
			'stock_min' => '100',
		]);



		Product::create([
			'category_id' => 3,
			'name' => 'Aliño 200gr',
			'peso_unit' => '0.200',
			'price' => '1000',
			'quantity_for_box' => '40',
			'medida' => 'Unidades',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 2,
			'quantity' => '50',
			'stock_min' => null,
		]);




		Product::create([
			'category_id' => 3,
			'name' => 'Aliño 400gr',
			'peso_unit' => '0.400',
			'price' => '1000',
			'quantity_for_box' => '30',
			'medida' => 'Unidades',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 3,
			'quantity' => '400',
			'stock_min' => '100',
		]);


		Product::create([
			'category_id' => 3,
			'name' => 'Aliño 800gr',
			'peso_unit' => '0.800',
			'price' => '1000',
			'quantity_for_box' => '20',
			'medida' => 'Unidades',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 4,
			'quantity' => '400',
			'stock_min' => '100',
		]);

		Product::create([
			'category_id' => 3,
			'name' => 'Aliño 45gr',
			'peso_unit' => '0.045',
			'price' => '1000',
			'quantity_for_box' => '10',
			'medida' => 'Unidades',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 5,
			'quantity' => '400',
			'stock_min' => '100',
		]);

		Product::create([
			'category_id' => 3,
			'name' => 'Aliño 90gr',
			'peso_unit' => '0.090',
			'price' => '1000',
			'quantity_for_box' => '10',
			'medida' => 'Unidades',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 6,
			'quantity' => '400',
			'stock_min' => '100',
		]);

		Product::create([
			'category_id' => 3,
			'name' => 'Aliño 14gr',
			'peso_unit' => '0.014',
			'price' => '1000',
			'quantity_for_box' => '24',
			'medida' => 'Unidades',
			'image' => '/img/imgDefault.jpeg'
		]);
		Inventory::create([
			'product_id' => 7,
			'quantity' => '400',
			'stock_min' => '100',
		]);

		Product::create([
			'category_id' => 1,
			'name' => 'Maiz',
			'price' => 3000,
			'medida' => 'Kg',
			'quantity_for_box' => '20',
		]);
		Inventory::create([
			'product_id' => 8,
			'Kg_L' => '400.00',
			'stock_min' => '100',
			// 'type_stock_min' => 'Kg_L',
		]);

		Product::create([
			'category_id' => 1,
			'name' => 'Arina Maiz',
			'price' => 3000,
			'medida' => 'Kg',
			'quantity_for_box' => '20',
		]);
		Inventory::create([
			'product_id' => 9,
			// 'type_stock_min' => 'Kg_L',
			'Kg_L' => '400.00',
			'stock_min' => '100',
		]);

		Product::create([
			'category_id' => 1,
			'name' => 'Aceite',
			'price' => 3000,
			'medida' => 'L',
			'quantity_for_box' => '12',
		]);
		Inventory::create([
			'product_id' => 10,
			// 'type_stock_min' => 'Kg_L',
			'Kg_L' => '800.00',
			'stock_min' => '100',
		]);

		Product::create([
			'category_id' => 1,
			'name' => 'Achote grano',
			'price' => 3000,
			'medida' => 'Kg',
			'quantity_for_box' => '20',
		]);
		Inventory::create([
			'product_id' => 11,
			// 'type_stock_min' => 'Kg_L',
			'Kg_L' => '200.00',
			'stock_min' => '100',
		]);

		Product::create([
        	'category_id' => 4,
			'name' => 'Aliño',
			'peso_unit' => '0.01',
			'price' => '1000',
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


	}
}
