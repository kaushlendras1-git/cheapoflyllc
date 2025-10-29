<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('travel_bookings', function (Blueprint $table) {
            $table->index(['user_id', 'created_at']);
            $table->index(['user_id', 'booking_status_id']);
            $table->index(['user_id', 'payment_status_id']);
            $table->index(['user_id', 'booking_status_id', 'created_at']);
            $table->index(['user_id', 'payment_status_id', 'created_at']);
        });

        Schema::table('call_logs', function (Blueprint $table) {
            $table->index(['user_id', 'created_at']);
            $table->index(['user_id', 'chkflight']);
            $table->index(['user_id', 'chkhotel']);
            $table->index(['user_id', 'chkcruise']);
            $table->index(['user_id', 'chkcar']);
            $table->index(['user_id', 'chktrain']);
        });

        Schema::table('travel_booking_types', function (Blueprint $table) {
            $table->index(['booking_id', 'type']);
        });
    }

    public function down()
    {
        Schema::table('travel_bookings', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'created_at']);
            $table->dropIndex(['user_id', 'booking_status_id']);
            $table->dropIndex(['user_id', 'payment_status_id']);
            $table->dropIndex(['user_id', 'booking_status_id', 'created_at']);
            $table->dropIndex(['user_id', 'payment_status_id', 'created_at']);
        });

        Schema::table('call_logs', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'created_at']);
            $table->dropIndex(['user_id', 'chkflight']);
            $table->dropIndex(['user_id', 'chkhotel']);
            $table->dropIndex(['user_id', 'chkcruise']);
            $table->dropIndex(['user_id', 'chkcar']);
            $table->dropIndex(['user_id', 'chktrain']);
        });

        Schema::table('travel_booking_types', function (Blueprint $table) {
            $table->dropIndex(['booking_id', 'type']);
        });
    }
};