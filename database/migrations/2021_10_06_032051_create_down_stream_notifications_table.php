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
            $table->string('status')->default('open'); // this is status document ; open, ccp process, ext process, done
            $table->unsignedBigInteger('notif_id')->nullable();
            $table->unsignedBigInteger('author_id');

            $table->string('number'); //document number

            /** Section 1 General Information */
            $table->string('number_ref')->nullable();
            $table->string('status_notif')->nullable();
            $table->string('type_notif')->nullable();
            $table->string('title');
            // $table->string('country_notif')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('based_notif')->nullable();
            $table->string('origin_source_notif')->nullable();
            $table->string('source_notif')->nullable();
            $table->dateTime('date_notif')->nullable();
            /** Section 2 Product Information */
            $table->string('product_name')->nullable();
            $table->string('category_product_name')->nullable();
            $table->string('brand_name')->nullable();
            $table->string('package_product')->nullable();
            $table->string('registration_number')->nullable();
            // $table->string('mass');
            

            $table->json('history')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->dateTime('finished_at')->nullable();
            $table->foreign('notif_id')->references('id')->on('notifications')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
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
