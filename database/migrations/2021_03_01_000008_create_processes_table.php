<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessesTable extends Migration
{
    public function up()
    {
        Schema::create('processes', function (Blueprint $table) {
            $table->increments('id_process');
            $table->string('name', 50)->unique();
            $table->string('description', 500)->nullable();
            $table->integer('sequence');
            $table->string('active', 1)->default('S');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('processes');
    }
}
