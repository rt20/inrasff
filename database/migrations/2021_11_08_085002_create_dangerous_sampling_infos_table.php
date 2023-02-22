<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDangerousSamplingInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dangerous_sampling_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('di_id');
            $table->dateTime('sampling_date')->nullable();
            // $table->double('sampling_count')->nullable();
            $table->string('sampling_count')->nullable();
            $table->string('sampling_method')->nullable();
            $table->string('sampling_place')->nullable();

            $table->string('name_result')->nullable();
            $table->unsignedBigInteger('uom_result_id')->nullable();

            $table->string('laboratorium')->nullable();
            $table->string('matrix')->nullable();

            $table->string('scope')->nullable();
            $table->string('max_tollerance')->nullable();

            $table->timestamps();

            $table->foreign('di_id')->references('id')->on('dangerous_infos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dangerous_sampling_infos');
    }
}
