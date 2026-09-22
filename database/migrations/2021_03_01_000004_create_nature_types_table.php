<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNatureTypesTable extends Migration
{
    public function up()
    {
        Schema::create('nature_types', function (Blueprint $table) {
            $table->increments('id_nature_type');
            $table->string('code', 1)->unique();
            $table->string('name', 30);
        });
    }

    public function down()
    {
        Schema::dropIfExists('nature_types');
    }
}
