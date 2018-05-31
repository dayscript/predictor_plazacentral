<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('first_team_id')->unsigned()->nullable();
            $table->foreign('first_team_id')->references('id')->on('teams')->onDelete('set null');
            $table->integer('second_team_id')->unsigned()->nullable();
            $table->foreign('second_team_id')->references('id')->on('teams')->onDelete('set null');
            $table->timestamps();
        });
        Schema::create('group_team', function (Blueprint $table) {
            $table->integer('group_id')->unsigned()->nullable();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->integer('team_id')->unsigned()->nullable();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->integer('order')->nullable();
            $table->timestamps();
        });
        Schema::table('matches', function ($table) {
            $table->integer('group_id')->unsigned()->nullable()->after('round_id');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('set null');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matches', function ($table) {
            $table->dropForeign('matches_group_id_foreign');
            $table->dropColumn('group_id');
        });

        Schema::dropIfExists('group_team');
        Schema::dropIfExists('groups');
    }
}
