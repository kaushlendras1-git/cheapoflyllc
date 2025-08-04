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
        Schema::table('travel_booking_remarks', function (Blueprint $table) {
            $table->boolean('status')->default(1); // 1 = visible, 0 = hidden
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('travel_booking_remarks', function (Blueprint $table) {
            //
        });
    }
};
