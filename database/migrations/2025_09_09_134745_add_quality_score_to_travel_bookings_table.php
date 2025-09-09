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
            $table->decimal('quality_score', 5, 2)->nullable()->after('merchant_fee'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('travel_bookings', function (Blueprint $table) {
         $table->decimal('quality_score', 5, 2)->nullable()->after('merchant_fee'); 
        });
    }
};
