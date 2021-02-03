<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceControllersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_controllers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('controller_name');
            $table->string('controller_type')->nullable();
            $table->string('controller_host')->nullable();
            $table->string('controller_port')->nullable();
            $table->string('controller_device_id')->nullable();
            $table->integer('controller_status');
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
        Schema::dropIfExists('device_controllers');
    }
}
