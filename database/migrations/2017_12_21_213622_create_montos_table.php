<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMontosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_solicitudes_montos', function (Blueprint $table) {
            //$table->increments('id_monto');
            $table->integer('id_solicitud');
            $table->integer('id_detalle');
            $table->integer('id_viatico');
            $table->integer('id_empresa');
            $table->integer('id_usuario');
            $table->enum('monto_tipo_solicitud',['Nacional','Extranjero'])->default('Nacional');
            $table->string('monto_tipo_pago');
            $table->double('monto_importe',36,9);
            $table->double('monto_importe_autorizado',36,9);
            $table->boolean('status')->default(1);
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
        
        Schema::dropIfExists('cat_solicitudes_montos');
    }
}
