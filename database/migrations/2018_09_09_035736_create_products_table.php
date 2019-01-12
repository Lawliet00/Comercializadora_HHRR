<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('name');
            $table->enum('medida', ['Kg', 'L','Unidades'])->default('Kg'); // tipo de medida
            $table->decimal('peso_unit',5,3)->nullable();
            $table->decimal('price',12,2)->nullable();
            $table->integer('quantity_for_box')->nullable();
            $table->string('image')->default('/img/imgDefault.jpeg')->nullable();
            $table->timestamps();
            // $table->integer('measure_id')->unsigned();
            // $table->foreign('measure_id')->references('id')->on('measures')->ondelete('cascade');

            // $table->integer('active');
            // $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
