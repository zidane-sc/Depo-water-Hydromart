<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStatusAlarmSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alarm_settings', function (Blueprint $table) {
           
            $table->integer('status')->nullable();
            // $table->unsignedBigInteger('device_controller_id');
            // $table->foreign('device_controller_id')->references('id')->on('device_controllers');
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
