<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveBookingStatusColumnsFromTravelBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('travel_bookings', function (Blueprint $table) {
            $table->dropColumn(['booking_status', 'payment_status']);
        });
    }

    public function down()
    {
        Schema::table('travel_bookings', function (Blueprint $table) {
            $table->string('booking_status')->nullable();
            $table->string('payment_status')->nullable();
        });
    }
}
