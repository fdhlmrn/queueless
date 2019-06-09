<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->unsigned();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->string('location');
            $table->string('company_name');
            $table->integer('company_contact')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
