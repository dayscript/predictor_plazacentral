<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last')->nullable();
            $table->string('email')->unique();
            $table->boolean('admin')->default(false);
            $table->string('avatar')->nullable();
            $table->string('identification_type')->nullable()->default('CC');
            $table->string('identification')->nullable()->unique();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->default('CO');
            $table->string('city')->default('Bogotá')->nullable();
            $table->string('gender')->nullable();
            $table->string('lang')->default('es');
            $table->boolean('promotions')->default(true);
            $table->integer('points')->default(0);
            $table->text('settings')->nullable()->default(null);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
