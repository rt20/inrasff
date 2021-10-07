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
            $table->unsignedBigInteger('ds_id'); // down streaam id
            $table->unsignedBigInteger('author_id');
            $table->string('status')->default('draft'); // draft, on process, accepted, rejected
            
            $table->string('title');
            $table->text('description')->nullable();
            
            $table->json('history')->nullable();
            $table->timestamps();
            $table->dateTime('accepted_at');

            $table->foreign('ds_id')->references('id')->on('down_stream_notifications')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
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
