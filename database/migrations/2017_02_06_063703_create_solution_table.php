<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolutionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solution', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('problem_id');
            $table->integer('time')->default(0);
            $table->integer('memory')->default(0);
            $table->integer('user_id');
            $table->integer('run_id');
            $table->smallInteger('result')->default(0);
            $table->smallInteger('language');
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
        Schema::dropIfExists('solution');
    }
}
