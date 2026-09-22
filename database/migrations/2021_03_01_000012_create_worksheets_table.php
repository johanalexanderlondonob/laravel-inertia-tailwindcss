<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksheetsTable extends Migration
{
    public function up()
    {
        Schema::create('worksheets', function (Blueprint $table) {
            $table->increments('id_worksheet');
            $table->string('period', 4);
            $table->unsignedInteger('id_customer');
            $table->string('opened', 1)->default('S');
            $table->timestamps();

            $table->unique(['id_customer', 'period']);
            $table->foreign('id_customer')->references('id_third')->on('customers')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('worksheets');
    }
}
