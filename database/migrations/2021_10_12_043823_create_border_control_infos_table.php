<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorderControlInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('border_control_infos', function (Blueprint $table) {
            $table->id();
            /**
             * Morph for Downstream and Upstream
             */
            $table->string('bci_type')->nullable();
            $table->unsignedBigInteger('bci_id')->nullable();

            $table->string('start_point')->nullable();
            $table->string('entry_point')->nullable();
            $table->string('supervision_point')->nullable();
            $table->unsignedBigInteger('destination_country_id')->nullable(); //destination country
            $table->string('consignee_name')->nullable();
            $table->text('consignee_address')->nullable();
            $table->string('container_number')->nullable();
            $table->string('transport_name')->nullable();
            $table->text('transport_description')->nullable();
            
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
        Schema::dropIfExists('border_control_infos');
    }
}
