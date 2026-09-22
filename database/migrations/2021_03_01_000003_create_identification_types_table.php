<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentificationTypesTable extends Migration
{
    public function up()
    {
        Schema::create('identification_types', function (Blueprint $table) {
            $table->increments('id_identification_type');
            $table->string('name', 30);
            $table->string('code_rips', 3)->nullable()->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('identification_types');
    }
}
