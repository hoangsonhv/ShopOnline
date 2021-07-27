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
            $table->id();
            $table->string("name");
            $table->string("image")->nullable();
            $table->text("description");
            $table->decimal("unit_price",14,2)->default(0);
            $table->decimal("promotion_price",14,2)->default(0);
            $table->unsignedInteger("qty")->default(0);
            $table->unsignedBigInteger("id_category")->unsigned()->nullable();
            $table->foreign("id_category")->references("id")->on("categories");
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
        Schema::dropIfExists('products');
    }
}
