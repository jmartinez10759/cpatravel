<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoliticaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_politicas', function (Blueprint $table) {
            $table->increments('id_politica');
            $table->double('importe_ded_nal',36,9);
            $table->double('importe_ded_ext',36,9);
            $table->double('importe_emp_nal',36,9);
            $table->double('importe_emp_ext',36,9);
            $table->boolean('status')->default(1);
            $table->integer('id_usuario');
            $table->integer('id_empresa');
            $table->integer('id_proyecto')->default(1);
            $table->integer('id_subproyecto')->default(1);
            $table->integer('id_viaje')->default(1);
            $table->integer('id_etiqueta');
            $table->enum('tipo',['predeterminadas','corporativas','usuario'])->default('predeterminadas');
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
        Schema::dropIfExists('tbl_politicas');
    }
}
