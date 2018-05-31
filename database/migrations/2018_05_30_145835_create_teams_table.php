<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
        Schema::table('matches', function ($table) {
            $table->integer('local_id')->unsigned()->nullable()->after('round_id');
            $table->foreign('local_id')->references('id')->on('teams')->onDelete('set null');
            $table->integer('visit_id')->unsigned()->nullable()->after('local_id');
            $table->foreign('visit_id')->references('id')->on('teams')->onDelete('set null');
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
            $table->dropForeign('matches_local_id_foreign');
            $table->dropForeign('matches_visit_id_foreign');
            $table->dropColumn('local_id');
            $table->dropColumn('visit_id');
        });
        Schema::dropIfExists('teams');
    }
}
