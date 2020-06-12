<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destination_cities', function (Blueprint $table) {
           $table->bigIncrements('id');
            $table->string('destination_city_name');
            $table->string('destination_city_code');
            $table->integer('from_city_id'); // its the Fk okay
            $table->boolean('status')->default(0); // active
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
        Schema::dropIfExists('destination_cities');
    }
}
