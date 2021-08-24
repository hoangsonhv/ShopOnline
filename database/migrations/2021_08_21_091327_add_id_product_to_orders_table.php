<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdProductToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer("id_product")->after("id_user");
            $table->integer("id_customer")->after("gender")->default(0);
            $table->bigInteger("id_bill")->after("id_user")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            Schema::dropIfExists('id_product');
            Schema::dropIfExists('id_customer');
            Schema::dropIfExists('id_bill');
        });
    }
}
