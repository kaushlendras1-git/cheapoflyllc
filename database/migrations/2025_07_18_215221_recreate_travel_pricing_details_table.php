<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('travel_pricing_details');

        Schema::create('travel_pricing_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->string('fare_type')->nullable();
            $table->decimal('base_fare', 10, 2)->nullable();
            $table->decimal('tax', 10, 2)->nullable();
            $table->decimal('markup', 10, 2)->nullable();
            $table->decimal('discount', 10, 2)->nullable();
            $table->decimal('total_fare', 10, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // If you don't want this constraint, remove this line below:
            $table->foreign('booking_id')->references('id')->on('travel_bookings')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('travel_pricing_details');
    }
};
