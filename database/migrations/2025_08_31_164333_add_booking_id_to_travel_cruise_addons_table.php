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
        Schema::table('travel_cruise_addons', function (Blueprint $table) {
             $table->unsignedBigInteger('booking_id')->after('id');
            $table->foreign('booking_id')->references('id')->on('travel_bookings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('travel_cruise_addons', function (Blueprint $table) {
            //
        });
    }
};
