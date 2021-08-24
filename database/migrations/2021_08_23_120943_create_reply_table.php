<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reply', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_comments")->unsigned()->nullable();
            $table->string("content");
            $table->unsignedBigInteger("id_user")->unsigned()->nullable();
            $table->unsignedBigInteger("id_product")->unsigned()->nullable();
            $table->foreign("id_user")->references("id")->on("users");
            $table->foreign("id_product")->references("id")->on("products");
            $table->foreign("id_comments")->references("id")->on("comments");
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
        Schema::dropIfExists('reply');
    }
}
