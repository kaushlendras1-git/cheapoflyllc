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
        Schema::create('travel_cruise', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('booking_id');
            $table->string('cruise_name', 255)->nullable();
            $table->string('ship_name', 255)->nullable();
            $table->string('length', 50)->nullable(); // Could be in days or length description
            $table->string('departure_port', 255)->nullable();
            $table->string('arrival_port', 255)->nullable();
            $table->string('cruise_line', 255)->nullable();
            $table->string('category', 255)->nullable();
            $table->string('stateroom', 255)->nullable();
            $table->timestamps();

             $table->foreign('booking_id')->references('id')->on('travel_bookings')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_cruise');
    }
};
