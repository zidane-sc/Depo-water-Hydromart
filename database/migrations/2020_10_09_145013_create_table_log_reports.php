<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLogReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('tstamp');
            $table->float('ph')->nullable();
            $table->float('tss')->nullable();
            $table->float('amonia')->nullable();
            $table->float('cod')->nullable();
            $table->float('flow_meter')->nullable();
            $table->string('controller_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_reports');
    }
}
