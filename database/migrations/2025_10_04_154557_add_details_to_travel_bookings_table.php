<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('travel_bookings', function (Blueprint $table) {
            $table->string('hotel_payment_type')->nullable();
            $table->string('cruise_payment_type')->nullable();
            $table->string('car_payment_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('travel_bookings', function (Blueprint $table) {
            $table->dropColumn('hotel_payment_type');
            $table->dropColumn('cruise_payment_type');
            $table->dropColumn('car_payment_type');
        });
    }
};
