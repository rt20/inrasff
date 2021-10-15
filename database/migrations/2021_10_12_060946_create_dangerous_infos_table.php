<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDangerousInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dangerous_infos', function (Blueprint $table) {
            $table->id();
            /**
             * Morph for Downstream and Upstream
             */
            $table->string('di_type')->nullable();
            $table->unsignedBigInteger('di_id')->nullable();

            $table->string('name')->nullable();
            $table->string('category')->nullable();
            $table->string('name_result')->nullable();
            $table->string('uom_result')->nullable();

            $table->string('laboratorium')->nullable();
            $table->string('matrix')->nullable();

            $table->string('scope')->nullable();
            $table->string('max_tollerance')->nullable();

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
        Schema::dropIfExists('dangerous_infos');
    }
}
