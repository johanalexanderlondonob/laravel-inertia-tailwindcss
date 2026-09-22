<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThirdRegimeTypesTable extends Migration
{
    public function up()
    {
        Schema::create('third_regime_types', function (Blueprint $table) {
            $table->increments('id_regime_type');
            $table->string('code_regime_type', 1)->unique();
            $table->string('name', 50);
        });
    }

    public function down()
    {
        Schema::dropIfExists('third_regime_types');
    }
}
