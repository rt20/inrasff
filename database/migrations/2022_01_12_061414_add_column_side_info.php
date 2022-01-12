<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSideInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('border_control_infos', function (Blueprint $table) {
            $table->string('notification_type')->nullable();
        });
        Schema::table('dangerous_infos', function (Blueprint $table) {
            $table->string('notification_type')->nullable();
        });
        Schema::table('follow_up_notifications', function (Blueprint $table) {
            $table->string('notification_type')->nullable();
        });
        Schema::table('notification_attachments', function (Blueprint $table) {
            $table->string('notification_type')->nullable();
        });
        Schema::table('risk_infos', function (Blueprint $table) {
            $table->string('notification_type')->nullable();
        });
        Schema::table('traceability_lot_infos', function (Blueprint $table) {
            $table->string('notification_type')->nullable();
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
