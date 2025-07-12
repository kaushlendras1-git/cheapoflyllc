<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusesToTravelBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('travel_bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('booking_status_id')->nullable()->after('user_id');
            $table->unsignedBigInteger('payment_status_id')->nullable()->after('booking_status_id');

            // Foreign key constraints
            $table->foreign('booking_status_id')->references('id')->on('booking_statuses')->onDelete('set null');
            $table->foreign('payment_status_id')->references('id')->on('payment_statuses')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('travel_bookings', function (Blueprint $table) {
            $table->dropForeign(['booking_status_id']);
            $table->dropForeign(['payment_status_id']);
            $table->dropColumn(['booking_status_id', 'payment_status_id']);
        });
    }
}

