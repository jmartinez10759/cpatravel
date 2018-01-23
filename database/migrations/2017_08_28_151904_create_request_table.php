<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests',function(Blueprint $table){
            $table->increments('id');
            $table->string('iden');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('departure_hour');
            $table->string('hour_return');
            $table->string('initial_destination');
            $table->integer('initial_destination_id');
            $table->string('final_destination');
            $table->integer('final_destination_id');
            $table->integer('days');
            $table->integer('project_id');
            $table->integer('subproject_id');
            $table->integer('travel_id');
            $table->string('user_id');
            $table->string('user_id_authorize')->nullable();
            $table->string('status')->default(1);
            $table->decimal('total_amount')->nullable();
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
            $table->decimal('naci_checks_auto')->default('0.00')->nullable();
            $table->decimal('naci_debit_auto')->default('0.00')->nullable();
            $table->decimal('naci_credit_auto')->default('0.00')->nullable();
            $table->decimal('naci_cash_auto')->default('0.00')->nullable();
            $table->decimal('naci_amex_auto')->default('0.00')->nullable();
            $table->decimal('extra_checks_auto')->default('0.00')->nullable();
            $table->decimal('extra_debit_auto')->default('0.00')->nullable();
            $table->decimal('extra_credi_auto')->default('0.00')->nullable();
            $table->decimal('extra_cash_auto')->default('0.00')->nullable();
            $table->decimal('extra_amex_auto')->default('0.00')->nullable();
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
        Schema::dropIfExists('requests');
    }
}
