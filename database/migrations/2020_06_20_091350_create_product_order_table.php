<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_order', function (Blueprint $table) {
            $table->unsignedBigInteger('order');
            $table->unsignedBigInteger('product');
            $table->float('price');
            $table->tinyInteger('qty');

            $table->foreign('order')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product')->references('id')->on('product')->onDelete('cascade')->onUpdate('cascade');

            $table->primary(['order','product']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_order');
    }
}
