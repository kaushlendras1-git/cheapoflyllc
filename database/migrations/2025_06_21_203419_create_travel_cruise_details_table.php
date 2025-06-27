<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('travel_cruise_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->nullable()->constrained('travel_bookings')->onDelete('cascade');
            $table->string('cruise_line')->nullable();
            $table->string('ship_name')->nullable();
            $table->string('category')->nullable();
            $table->string('stateroom')->nullable();
            $table->string('departure_port')->nullable();
            $table->date('departure_date')->nullable();
            $table->unsignedTinyInteger('departure_hrs')->nullable();
            $table->unsignedTinyInteger('departure_mm')->nullable();
            $table->string('arrival_port')->nullable();
            $table->date('arrival_date')->nullable();
            $table->unsignedTinyInteger('arrival_hrs')->nullable();
            $table->unsignedTinyInteger('arrival_mm')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->index('booking_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('travel_cruise_details');
    }
};