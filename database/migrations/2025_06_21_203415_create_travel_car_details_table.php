<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('travel_car_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->nullable()->constrained('travel_bookings')->onDelete('cascade');
            $table->string('car_rental_provider')->nullable();
            $table->string('car_type')->nullable();
            $table->string('pickup_location')->nullable();
            $table->string('dropoff_location')->nullable();
            $table->date('pickup_date')->nullable();
            $table->time('pickup_time')->nullable();
            $table->date('dropoff_date')->nullable();
            $table->time('dropoff_time')->nullable();
            $table->string('confirmation_number')->nullable();
            $table->text('remarks')->nullable();
            $table->text('rental_provider_address')->nullable();
            $table->timestamps();
            $table->index('booking_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('travel_car_details');
    }
};