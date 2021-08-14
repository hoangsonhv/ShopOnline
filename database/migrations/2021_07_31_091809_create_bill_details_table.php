<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_details', function (Blueprint $table) {
            $table->id();
            $table->integer("quantity");
            $table->decimal("price",14,2)->default(0);
            $table->unsignedBigInteger("id_bill")->unsigned()->nullable();
            $table->unsignedBigInteger("id_product")->unsigned()->nullable();
            $table->foreign("id_bill")->references("id")->on("bills");
            $table->foreign("id_product")->references("id")->on("products");
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
        Schema::dropIfExists('bill_details');
    }
}
