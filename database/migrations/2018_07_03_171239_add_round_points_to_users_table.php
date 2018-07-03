<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoundPointsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('points_group_phase')->default(0)->after('points');
            $table->integer('points_round_of_16')->default(0)->after('points_group_phase');
            $table->integer('points_quarter_finals')->default(0)->after('points_round_of_16');
            $table->integer('points_semi_finals')->default(0)->after('points_quarter_finals');
            $table->integer('points_finals')->default(0)->after('points_semi_finals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('points_finals');
            $table->dropColumn('points_semi_finals');
            $table->dropColumn('points_quarter_finals');
            $table->dropColumn('points_round_of_16');
            $table->dropColumn('points_group_phase');
        });
    }
}
