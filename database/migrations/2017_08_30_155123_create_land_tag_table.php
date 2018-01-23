<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('land_tags',function(Blueprint $table){
            $table->increments('id');
            $table->string('iden');
            $table->string('request_id');
            $table->integer('type_nationality');
            $table->string('place_origin');
            $table->string('place_destination');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_amount');
            $table->decimal('naci_checks')->default('0.00')->nullable();
            $table->decimal('naci_debit')->default('0.00')->nullable();
            $table->decimal('naci_credit')->default('0.00')->nullable();
            $table->decimal('naci_cash')->default('0.00')->nullable();
            $table->decimal('naci_amex')->default('0.00')->nullable();
            $table->decimal('extra_checks')->default('0.00')->nullable();
            $table->decimal('extra_debit')->default('0.00')->nullable();
            $table->decimal('extra_credi')->default('0.00')->nullable();
            $table->decimal('extra_cash')->default('0.00')->nullable();
            $table->decimal('extra_amex')->default('0.00')->nullable();
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
        Schema::dropIfExists('land_tags');
    }
}
