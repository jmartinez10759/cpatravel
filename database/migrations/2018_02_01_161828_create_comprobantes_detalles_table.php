<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprobantesDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comprobantes_detalles', function (Blueprint $table) {
            $table->increments('id_comprobante_detalle');
            $table->integer('id_comprobante');
            $table->string('concepto');
            $table->string('clave_prod');
            $table->integer('cantidad');
            $table->string('unidad');
            $table->text('descripcion');
            $table->double('valor_unitario',36,9);
            $table->double('importe',36,9);
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
        Schema::dropIfExists('comprobantes_detalles');
    }
}
