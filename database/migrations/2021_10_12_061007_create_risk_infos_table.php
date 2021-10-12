<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiskInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('risk_infos', function (Blueprint $table) {
            $table->id();
            /**
             * Morph for Downstream and Upstream
             */
            $table->string('ri_type')->nullable();
            $table->unsignedBigInteger('ri_id')->nullable();

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
        Schema::dropIfExists('risk_infos');
    }
}
