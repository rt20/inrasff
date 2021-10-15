<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowUpNotificationAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow_up_notification_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fun_id');
            $table->string('title');
            $table->timestamps();

            $table->foreign('fun_id')->references('id')->on('follow_up_notifications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follow_up_notification_attachments');
    }
}
