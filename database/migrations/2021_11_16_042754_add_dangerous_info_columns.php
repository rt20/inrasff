<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDangerousInfoColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dangerous_infos', function(BluePrint $table){
            
            $table->foreign('category_id')->references('id')->on('dangerous_categories')->onDelete('cascade');

            /**
             * cl = category level
             */
            $table->unsignedBigInteger('cl1_id')->nullable();
            $table->unsignedBigInteger('cl2_id')->nullable();
            $table->unsignedBigInteger('cl3_id')->nullable();

            $table->foreign('cl1_id')->references('id')->on('dangerous_category_levels')->onDelete('cascade');
            $table->foreign('cl2_id')->references('id')->on('dangerous_category_levels')->onDelete('cascade');
            $table->foreign('cl3_id')->references('id')->on('dangerous_category_levels')->onDelete('cascade');
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
