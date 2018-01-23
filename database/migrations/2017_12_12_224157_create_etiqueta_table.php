<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtiquetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_etiquetas', function (Blueprint $table) {
            
            $table->increments('id_etiqueta');
            $table->integer('id_usuario');
            $table->integer('id_empresa');
            $table->text('etiqueta_img');
            $table->string('etiqueta_nombre');
            $table->text('etiqueta_descripcion');
            $table->enum('etiqueta_tipo',['predeterminadas','corporativas','usuario']);
            $table->text('etiqueta_tipo_img');
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
        Schema::dropIfExists('tbl_etiquetas');
    }
}
