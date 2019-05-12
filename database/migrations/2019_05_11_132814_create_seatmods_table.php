<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatmodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seatmods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('party_id');
            $table->float('modifier');
            
            $table->foreign('party_id')->references('id')->on('parties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seatmods');
    }
}
