<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('foods', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->index()->unsigned();
          $table->float('latitude');
          $table->float('longitude');
          $table->string('location')->nullable();
          $table->string('nama_makanan');
          $table->integer('saiz_hidangan');
          $table->string('image');
          $table->double('harga');
          $table->timestamps();

            //foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 

      });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('foods');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
