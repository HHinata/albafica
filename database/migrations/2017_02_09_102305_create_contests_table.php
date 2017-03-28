<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('desc');

            $table->string('password')->default("");
            $table->integer('team_id')->default(0);
            $table->integer('user_id');

            $table->boolean('defunct')->default(0);
            $table->smallInteger('private')->default(0);

            $table->bigInteger('start_time')->default(0);
            $table->bigInteger('end_time')->default(0);

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
        Schema::dropIfExists('contests');
    }
}
