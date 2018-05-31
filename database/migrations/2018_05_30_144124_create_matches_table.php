<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rounds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->boolean('special')->default(false);
            $table->timestamps();
        });
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('date')->nullable();
            $table->string('status')->default('pending')->nullable();
            $table->integer('round_id')->unsigned()->nullable();
            $table->foreign('round_id')->references('id')->on('rounds')->onDelete('set null');
            $table->integer('local_score')->nullable();
            $table->integer('visit_score')->nullable();
            $table->string('channel')->nullable();
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
        Schema::dropIfExists('matches');
        Schema::dropIfExists('rounds');
    }
}
