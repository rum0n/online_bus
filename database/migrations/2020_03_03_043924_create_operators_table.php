<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operators', function (Blueprint $table) {
           $table->bigIncrements('id');
            $table->string('operator_name');
            $table->string('operator_email');
            $table->string('operator_phone');
            $table->string('operator_address');
            $table->boolean('status')->default(0); // is the active status okay
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
        Schema::dropIfExists('operators');
    }
}
