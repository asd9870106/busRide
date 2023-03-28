<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('station_qrcode_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('station_id');
            $table->string('bus_number');
            $table->string('station_name');
            $table->binary('qrcode_image');
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
        Schema::dropIfExists('station_qrcode_lists');
    }
};
