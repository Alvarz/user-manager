<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties_facilities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->unsigned()->index();
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->integer('facility_id')->unsigned()->index();
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
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
        Schema::drop('properties_facilities');
    }
}
