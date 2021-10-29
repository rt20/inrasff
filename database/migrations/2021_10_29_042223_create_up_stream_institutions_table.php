<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpStreamInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('up_stream_institutions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('us_id');
            $table->unsignedBigInteger('institution_id');
            $table->boolean('read')->default(true);
            $table->boolean('write')->default(false);
            $table->timestamps();

            $table->foreign('us_id')->references('id')->on('up_stream_notifications')->onDelete('cascade');
            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('up_stream_institutions');
    }
}
