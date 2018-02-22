<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprobantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comprobantes', function (Blueprint $table) {
            $table->increments('id_comprobante');
            $table->integer('id_usuario');
            $table->integer('id_empresa');
            $table->integer('id_proyecto');
            $table->integer('id_subproyecto');
            $table->integer('id_viaje');
            $table->string('uuid');
            $table->string('rfc_emisor');
            $table->string('rfc_receptor');
            $table->double('importe',39,9);
            $table->text('comentarios');
            $table->date('fecha_emision');
            $table->boolean('estatus')->default(1);
            $table->string('concepto');
            $table->text('imagen');
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
        Schema::dropIfExists('comprobantes');
    }
}
