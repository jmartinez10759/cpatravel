<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rel_usuarios_proyectos', function (Blueprint $table) {
            $table->integer('id_usuario');
            $table->integer('id_proyecto');
            $table->integer('id_subproyecto');
            $table->integer('id_viaje');
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
        Schema::dropIfExists('rel_usuarios_proyectos');
    }
}
