<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraceabilityLotInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traceability_lot_infos', function (Blueprint $table) {
            $table->id();
            /**
             * Morph for Downstream and Upstream
             */
            $table->string('tli_type')->nullable();
            $table->unsignedBigInteger('tli_id')->nullable();

            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('number')->nullable();
            /**
             * Date Information
             */
            $table->dateTime('used_by')->nullable();
            $table->dateTime('best_before')->nullable();
            $table->dateTime('sell_by')->nullable();

            /**
             * Description about lot
             */
            $table->string('number_unit')->nullable();
            $table->double('net_weight')->nullable();

            /**
             * Health Certificate
             */
            $table->string('cert_number')->nullable();
            $table->dateTime('cert_date')->nullable();
            $table->string('cert_institution')->nullable();

            /**
             * Additional Certificate
             */
            $table->string('add_cert_number')->nullable();
            $table->dateTime('add_cert_date')->nullable();
            $table->string('add_cert_institution')->nullable();
            


            $table->timestamps();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traceability_lot_infos');
    }
}
