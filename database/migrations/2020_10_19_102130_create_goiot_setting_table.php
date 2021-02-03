<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoiotSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goiot_setting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('host');
            $table->string('deviceid');
            $table->string('clientid');
            $table->string('username');
            $table->string('password');
            $table->integer('port')->nullable()->default('1883');
            $table->integer('keepalive')->nullable()->default('0');
            $table->string('ph_tag');
            $table->string('tss_tag');
            $table->string('amonia_tag');
            $table->string('cod_tag');
            $table->string('flowmeter_tag');
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
        Schema::dropIfExists('goiot_setting');
    }
}
