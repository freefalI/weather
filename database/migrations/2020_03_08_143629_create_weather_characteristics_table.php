<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherCharacteristicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_characteristics', function (Blueprint $table) {
            $table->id();
//            $table->timestamps();
            $table->integer('station_id');
            $table->string('value');
            $table->string('type')->nullable();
            $table->timestamp('measured_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather_characteristics');
    }
}
