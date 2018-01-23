<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViaticosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_viaticos_detalles', function (Blueprint $table) {
            $table->increments('id_detalle');
            $table->integer('id_solicitud');
            $table->integer('id_viatico');
            $table->integer('id_usuario');
            $table->integer('id_empresa');
            $table->integer('viatico_cantidad');
            $table->string('viatico_unidad');
            $table->double('viatico_costo_unitario',36,9);
            //$table->double('viatico_costo_total',36,9);
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
        Schema::dropIfExists('cat_viaticos_detalles');
    }
}
