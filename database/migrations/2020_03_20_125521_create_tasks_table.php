<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('description', 1000);
            $table->string('comment', 1000)->nullable();
            $table->unsignedBigInteger('problem_type_id');
//            $table->string('address')->nullable();
            $table->string('latitude1', 15)->nullable();
            $table->string('latitude2', 15)->nullable();
            $table->string('longitude1', 15)->nullable();
            $table->string('longitude2', 15)->nullable();
            $table->unsignedBigInteger('creator_id');
            $table->timestamps();

            $table->foreign('creator_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('problem_type_id')->references('id')->on('road_problem_types')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
