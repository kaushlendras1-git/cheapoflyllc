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
        if (!Schema::hasColumn('travel_pricing_details', 'passenger_type')) {
            $table->string('passenger_type')->nullable();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('travel_pricing_details', function (Blueprint $table) {
            $table->dropColumn('passenger_type');
        });
    }
};
