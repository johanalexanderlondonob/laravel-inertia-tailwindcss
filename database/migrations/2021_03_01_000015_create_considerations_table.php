<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsiderationsTable extends Migration
{
    public function up()
    {
        Schema::create('considerations', function (Blueprint $table) {
            $table->increments('id_consideration');
            $table->unsignedInteger('id_worksheet_detail');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('consideration', 1024);
            for ($i = 1; $i <= 9; $i++) {
                $table->string("path_image{$i}", 1024)->nullable();
            }
            $table->timestamps();

            $table->foreign('id_worksheet_detail')->references('id_worksheet_detail')->on('worksheets_details')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('considerations');
    }
}
