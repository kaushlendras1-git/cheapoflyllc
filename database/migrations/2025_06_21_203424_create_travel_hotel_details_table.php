<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('travel_hotel_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->nullable()->constrained('travel_bookings')->onDelete('cascade');
            $table->string('hotel_name')->nullable();
            $table->string('room_category')->nullable();
            $table->date('checkin_date')->nullable();
            $table->date('checkout_date')->nullable();
            $table->unsignedInteger('no_of_rooms')->nullable();
            $table->string('confirmation_number')->nullable();
            $table->text('hotel_address')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->index('booking_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('travel_hotel_details');
    }
};