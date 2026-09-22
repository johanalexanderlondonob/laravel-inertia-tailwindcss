<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessesLeadersTable extends Migration
{
    public function up()
    {
        // The ProcessLeader model (App\Arketops\ProcessLeader\ProcessLeader) does not
        // override $primaryKey, so it expects a standard auto-incrementing `id`, unlike
        // the original hand-written SQL dump which had no primary key at all.
        Schema::create('processes_leaders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_process');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('active', 1)->default('S');
            $table->timestamps();

            $table->foreign('id_process')->references('id_process')->on('processes')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('processes_leaders');
    }
}
