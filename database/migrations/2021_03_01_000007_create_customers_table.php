<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->unsignedInteger('id_third')->primary();
            $table->string('alias', 50)->nullable()->unique();
            $table->string('active', 1)->default('S');
            $table->timestamps();

            $table->foreign('id_third')->references('id_third')->on('thirds')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
