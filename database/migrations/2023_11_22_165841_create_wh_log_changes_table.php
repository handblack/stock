<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhLogChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wh_log_changes', function (Blueprint $table) {
            $table->id();
            $table->string('module',50);            
            $table->text('message')->nullable();
            $table->foreignId('usuario_id')->nullable();
            $table->foreign('usuario_id')->references('usuario_id')->on('usuarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wh_log_changes');
    }
}
