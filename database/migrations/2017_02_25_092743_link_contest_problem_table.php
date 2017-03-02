<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LinkContestProblemTable extends Migration
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
            $table->unsignedInteger('contest_id');
            $table->integer('order');
            $table->string('alias')->nullable();
            $table->integer('submited')->default(0);
            $table->integer('solved')->default(0);
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
