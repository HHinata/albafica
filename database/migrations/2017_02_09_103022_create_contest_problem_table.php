<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestProblemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest_problem', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('problem_id');
            $table->foreign('problem_id')->references('id')->on('problem')->onDelete('cascade');
            $table->unsignedInteger('contest_id');
            $table->foreign('contest_id')->references('id')->on('contest')->onDelete('cascade');
            $table->integer('order');
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
        Schema::dropIfExists('contest_problem');
    }
}
