<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDownStreamNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('down_stream_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('open'); // open, ccp process, ext process, done
            $table->unsignedBigInteger('notif_id')->nullable();
            $table->string('number');
            $table->json('history')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->dateTime('finished_at');
            $table->foreign('notif_id')->references('id')->on('notifications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('down_stream_notifications');
    }
}
