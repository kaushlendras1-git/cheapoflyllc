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
            $table->text('train_description')->nullable()->after('selected_company');
            $table->text('car_description')->nullable()->after('train_description');
            $table->text('hotel_description')->nullable()->after('car_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('travel_bookings', function (Blueprint $table) {
            $table->dropColumn(['train_description', 'car_description', 'hotel_description']);
        });
    }
};
