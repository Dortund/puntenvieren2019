<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('text');
            $table->dateTime('time_of_vote');
            $table->unsignedBigInteger('vote_value_type');
            
            $table->foreign('vote_value_type')->references('id')->on('vote_value_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motion');
    }
}
