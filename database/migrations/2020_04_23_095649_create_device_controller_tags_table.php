<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceControllerTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_controller_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tag_name');
            $table->string('tag_address')->nullable();
            $table->string('tag_data_type')->nullable();
            $table->unsignedBigInteger('device_controller_id');
            $table->foreign('device_controller_id')->references('id')->on('device_controllers');
            $table->integer('tag_status');
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
        Schema::dropIfExists('device_controller_tags');
    }
}
