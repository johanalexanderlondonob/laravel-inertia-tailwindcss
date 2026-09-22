<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubprocessesTable extends Migration
{
    public function up()
    {
        Schema::create('subprocesses', function (Blueprint $table) {
            $table->increments('id_subprocess');
            $table->unsignedInteger('id_process')->nullable();
            $table->string('name', 50);
            $table->string('description', 500)->nullable();
            $table->integer('execution_order');
            $table->string('active', 1)->default('S');
            $table->timestamps();

            $table->foreign('id_process')->references('id_process')->on('processes')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('subprocesses');
    }
}
