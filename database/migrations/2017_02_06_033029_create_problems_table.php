<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->increments('id');
            $table->char('platform', 5);
            $table->char('sign', 10)->default('');

            $table->string('title');
            $table->text('desc');
            $table->text('input');
            $table->text('output');

            $table->text('sample_input');
            $table->text('sample_output');

            $table->string('data_input')->default('');
            $table->string('data_output')->default('');

            $table->integer('solved')->default(0);
            $table->integer('submited')->default(0);

            $table->integer('time_limit');
            $table->integer('mem_limit');

            $table->string('hint')->default('');
            $table->string('author')->default('');
            $table->string('source')->default('');

            $table->boolean('private')->default(0);
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
        Schema::dropIfExists('problems');
    }
}
