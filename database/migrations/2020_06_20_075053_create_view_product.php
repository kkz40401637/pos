<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // $sql = "create view view_product as select
        //         p.id,
        //         p.name,
        //         p.name_kh,
        //         p.price,
        //         p.photo,
        //         p.dsc,
        //         p.category,
        //         concat(c.name,'-',c.name_kh) as category_name
        //         form category c INNER JOIN product p on p.category = c.id";

        //         DB:statement($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::statement("drop view if exits view_product;");
    }
}
