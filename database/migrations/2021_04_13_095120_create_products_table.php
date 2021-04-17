<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->integer('user_id')->unsigned();
            $table->string('product_sku', 50);
            $table->string('product_name', 50);
            $table->float('product_price', 10, 10);
            $table->float('product_weight', 10, 10);
            $table->string('description', 255);
            $table->string('product_shortdesk', 100);
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
        Schema::table('products', function($table){
            $table->dropColumn('product_id');
            $table->dropColumn('product_thumb');
            $table->dropColumn('product_location');
        });
    }
}
