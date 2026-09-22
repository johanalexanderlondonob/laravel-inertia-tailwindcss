<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThirdsTable extends Migration
{
    public function up()
    {
        Schema::create('thirds', function (Blueprint $table) {
            $table->increments('id_third');
            $table->unsignedInteger('id_city');
            $table->unsignedInteger('id_nature_type');
            $table->unsignedInteger('id_identification_type');
            $table->unsignedInteger('id_regime_type');
            $table->string('nit', 15)->unique();
            $table->string('third_name', 100);
            $table->string('name1', 30)->nullable();
            $table->string('name2', 30)->nullable();
            $table->string('lastname1', 30)->nullable();
            $table->string('lastname2', 30)->nullable();
            $table->string('address', 50);
            $table->string('phone1', 15);
            $table->string('phone2', 15)->nullable();
            $table->string('email', 50);
            $table->timestamps();

            $table->foreign('id_city')->references('id_city')->on('cities')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_nature_type')->references('id_nature_type')->on('nature_types')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_identification_type')->references('id_identification_type')->on('identification_types')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_regime_type')->references('id_regime_type')->on('third_regime_types')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('thirds');
    }
}
