<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksheetsProcessesTable extends Migration
{
    public function up()
    {
        Schema::create('worksheets_processes', function (Blueprint $table) {
            $table->increments('id_worksheet_process');
            $table->unsignedInteger('id_process');
            $table->dateTime('ideal_completion_date');
            $table->unsignedInteger('id_worksheet');
            $table->foreignId('creator_user')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();

            $table->foreign('id_process')->references('id_process')->on('processes')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_worksheet')->references('id_worksheet')->on('worksheets')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('worksheets_processes');
    }
}
