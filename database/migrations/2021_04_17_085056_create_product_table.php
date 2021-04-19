<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
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
            $table->integer('categories_product_id')->unsigned();
            $table->string('product_name', 50);
            $table->float('product_price', 5, 5);
            $table->float('product_weight', 5, 5);
            $table->string('product_taste', 50);
            $table->string('description', 255);
            $table->string('product_image', 100);
            $table->timestamp('product_update_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('product_stock');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
