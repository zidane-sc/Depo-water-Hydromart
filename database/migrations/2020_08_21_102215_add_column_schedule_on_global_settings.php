<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnScheduleOnGlobalSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('global_settings', function (Blueprint $table) {
            $table->integer('schedule_second')->nullable();
            $table->integer('schedule_minute')->nullable();
            $table->integer('schedule_hour')->nullable();
            $table->integer('schedule_day_of_month')->nullable();
            $table->integer('schedule_month')->nullable();
            $table->integer('schedule_day_of_week')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
