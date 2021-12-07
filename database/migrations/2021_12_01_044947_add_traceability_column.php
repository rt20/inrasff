<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTraceabilityColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('traceability_lot_infos', function(Blueprint $table){
            $table->string('cved_number')->nullable();

            /**
             * Produsen
             */
            $table->string('producer_name')->nullable();
            $table->text('producer_address')->nullable();
            $table->string('producer_city')->nullable();
            $table->unsignedBigInteger('producer_country_id')->nullable();
            $table->string('producer_approval')->nullable();
            $table->foreign('producer_country_id')->references('id')->on('countries')->onDelete('cascade');

            /**
             * Importir
             */
            $table->string('importer_name')->nullable();
            $table->text('importer_address')->nullable();
            $table->string('importer_city')->nullable();
            $table->unsignedBigInteger('importer_country_id')->nullable();
            $table->string('importer_approval')->nullable();
            $table->foreign('importer_country_id')->references('id')->on('countries')->onDelete('cascade');

            /**
             * Wholesaler
             */
            $table->string('wholesaler_name')->nullable();
            $table->text('wholesaler_address')->nullable();
            $table->string('wholesaler_city')->nullable();
            $table->unsignedBigInteger('wholesaler_country_id')->nullable();
            $table->string('wholesaler_approval')->nullable();
            $table->foreign('wholesaler_country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
