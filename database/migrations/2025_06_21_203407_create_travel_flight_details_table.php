<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('travel_flight_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->nullable()->constrained('travel_bookings')->onDelete('cascade');
            $table->string('direction')->nullable();
            $table->date('date')->nullable();
            $table->string('airlines_code')->nullable();
            $table->string('flight_no')->nullable();
            $table->string('cabin')->nullable();
            $table->string('class_of_service')->nullable();
            $table->string('departure_airport')->nullable();
            $table->unsignedTinyInteger('departure_hrs')->nullable();
            $table->unsignedTinyInteger('departure_mm')->nullable();
            $table->string('arrival_airport')->nullable();
            $table->unsignedTinyInteger('arrival_hrs')->nullable();
            $table->unsignedTinyInteger('arrival_mm')->nullable();
            $table->string('duration')->nullable();
            $table->string('transit')->nullable();
            $table->date('arrival_date')->nullable();
            $table->timestamps();
            $table->index('booking_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('travel_flight_details');
    }
};