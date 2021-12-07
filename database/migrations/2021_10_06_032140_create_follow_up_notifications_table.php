<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowUpNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow_up_notifications', function (Blueprint $table) {
            $table->id();
            /**
             * Morph for Downstream and Upstream
             */
            $table->string('fun_type')->nullable();
            $table->unsignedBigInteger('fun_id')->nullable();
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('receipt_id')->nullable();
            $table->string('status')->default('draft'); // draft, on process, accepted, rejected
            
            $table->string('title');
            $table->text('description')->nullable();
            
            $table->text('history')->nullable();
            $table->timestamps();
            $table->dateTime('accepted_at')->nullable();

            // $table->foreign('ds_id')->references('id')->on('down_stream_notifications')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receipt_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follow_up_notifications');
    }
}
