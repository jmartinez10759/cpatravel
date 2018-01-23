<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_solicitudes_companion', function (Blueprint $table) {
            $table->increments('id_companion');
            $table->integer('id_solicitud');
            $table->integer('id_empresa');
            $table->integer('id_usuario');
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
        Schema::dropIfExists('cat_solicitudes_companion');
    }
}
