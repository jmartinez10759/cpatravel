<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relation_projects', function (Blueprint $table) {
            $table->bigInteger('user_id');
            $table->bigInteger('project_id');
            $table->bigInteger('sub_project_id');
            $table->bigInteger('travel_id');
            $table->bigInteger('business_id');
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->primary(['user_id','project_id','sub_project_id','travel_id','business_id'],'llaves');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relation_projects');
    }
}
