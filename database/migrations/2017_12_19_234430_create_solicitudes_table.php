<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_solicitudes', function (Blueprint $table) {
            $table->increments('id_solicitud');
            $table->integer('id_proyecto');
            $table->integer('id_subproyecto');
            $table->integer('id_viaje');
            $table->integer('id_usuario');
            $table->integer('id_empresa');
            $table->date('solicitud_fecha_inicio');
            $table->date('solicitud_fecha_fin');
            $table->string('solicitud_horario_inicio');
            $table->string('solicitud_horario_fin');
            $table->string('solicitud_destino_inicio');
            $table->string('solicitud_destino_final');
            $table->enum('estatus',['Pendiente','Rechazado','Autorizado','Cancelado','Enviado'])->default('Pendiente');
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
        Schema::dropIfExists('tbl_solicitudes');
    }
}
