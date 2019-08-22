<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('home_id')->unique();
            $table->string('home_title');
            $table->text('home_summary');
            $table->longText('home_description');
            $table->integer('bedrooms');
            $table->json('bathrooms');
            $table->integer('sleeps');
            $table->json('price');
            $table->json('address');
            $table->json('location');
            $table->json('amenities');
            $table->string('mapimg');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('properties');
    }
}
