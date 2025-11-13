<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('travel_changes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('description')->nullable();
            $table->text('remarks')->nullable();
            $table->string('progress_status')->nullable();
            $table->unsignedBigInteger('attempted_by');
            $table->timestamps();
            
            $table->foreign('booking_id')->references('id')->on('travel_bookings')->onDelete('cascade');
            $table->foreign('attempted_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('travel_changes');
    }
};