<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDangerousRiskInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dangerous_risk_infos', function (Blueprint $table) {
            $table->id();
            /**
             * Morph for Downstream and Upstream
             */
            $table->string('dri_type')->nullable();
            $table->unsignedBigInteger('dri_id')->nullable();
            /**
             * Dangerous section
             */
            $table->string('name_dangerous')->nullable();
            $table->string('category_dangerous')->nullable();
            $table->string('name_result')->nullable();
            $table->string('uom_result')->nullable();

            $table->string('laboratorium')->nullable();
            $table->string('matrix')->nullable();

            $table->string('scope')->nullable();
            $table->string('max_tollerance')->nullable();
             /**
              * Risk section
              */
            $table->string('distribution_status')->nullable();
            $table->string('serious_risk')->nullable();
            $table->integer('victim')->nullable();
            $table->string('symptom')->nullable();
            
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
        Schema::dropIfExists('dangerous_risk_infos');
    }
}
