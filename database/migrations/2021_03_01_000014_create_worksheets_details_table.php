<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksheetsDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('worksheets_details', function (Blueprint $table) {
            $table->increments('id_worksheet_detail');
            $table->unsignedInteger('id_worksheet');
            $table->unsignedInteger('id_subprocess');
            $table->foreignId('id_user')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('id_status')->nullable();
            $table->timestamps();

            $table->foreign('id_worksheet')->references('id_worksheet')->on('worksheets')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_subprocess')->references('id_subprocess')->on('subprocesses')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_status')->references('id_status')->on('statuses')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('worksheets_details');
    }
}
