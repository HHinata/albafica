<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solutions', function (Blueprint $table) {
            $table->increments('id');

            $table->char('sign', 20);
            $table->char('platform', 3);
            $table->integer('problem_id');

            $table->integer('user_id');
            $table->integer('run_id')->nullable();
            $table->integer('contest_id')->default(0);

            $table->text('code');

            $table->integer('time')->default(0);
            $table->integer('memory')->default(0);

            /**
             * 0-g++
             * 1-gcc
             */
            $table->smallInteger('lang');
            $table->smallInteger('result')->default(0);
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
        Schema::dropIfExists('solutions');
    }
}
