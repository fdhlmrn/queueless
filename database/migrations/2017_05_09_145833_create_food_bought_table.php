<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodBoughtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_bought', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller_id');
            $table->integer('buyer_id');
            $table->integer('food_id')->unsigned();
            $table->integer('quantity');
            $table->double('totalPrice');
            $table->timestamps();

            //foreignkey
            $table->foreign('food_id')->references('id')->on('foods')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_bought');
    }
}
