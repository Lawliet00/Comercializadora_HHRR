<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

            // cambiar por el vendedor
            // $table->integer('designer_id')->unsigned()->nullable();
            // $table->foreign('designer_id')->references('id')->on('users');

            // $table->integer('invoice_id')->unsigned()->nullable();
            // $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->string('number');
            //Datos
            // $table->string('name')->nullable();
            // $table->text('description')->nullable();
            // $table->text('aditional_side')->nullable();
            $table->date('date')->nullable();
            $table->date('date_promise')->nullable();
            // $table->decimal('deposito',12,2)->default(0);
            // $table->decimal('rush')->default(0);
            // $table->decimal('discount')->default(0);
            // $table->decimal('delivery')->default(0);
            $table->decimal('subtotal');
            $table->decimal('tax',12,2);
            $table->decimal('total',12,2);
            // $table->integer('prioridad');
            // $table->text('sms')->nullable();
            // $table->string('email')->nullable();
            // $table->integer('sms_notif')->default(0);
            // $table->integer('correo_notif')->default(0);
            // $table->integer('preview_design')->default(0);
            // $table->integer('ship')->default(0);
            // $table->integer('costumer')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
