<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadocuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estadocuentas', function (Blueprint $table) {
            $table->increments('id_cuenta');
            $table->integer('id_proyecto');
            $table->integer('id_subproyecto');
            $table->integer('id_viaje');
            $table->integer('id_movimiento');
            $table->integer('id_etiqueta');
            $table->integer('id_relacion');
            $table->integer('id_usuario');
            $table->integer('id_empresa');
            $table->boolean('status')->default(1);
            $table->date('fecha');
            $table->double('importe',36,9);
            $table->double('importe_comprobado',36,9);
            $table->string('proceso');
            $table->string('metodo_pago');
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
        Schema::dropIfExists('estadocuentas');
    }
}
