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
        Schema::table('travel_cruise_details', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn(['cruise_line', 'ship_name', 'category', 'stateroom']);

            // Add new columns
            $table->string('day', 50)->nullable()->after('booking_id');
            $table->enum('type', ['trip', 'day_at_sea'])->nullable()->after('day');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('travel_cruise_details', function (Blueprint $table) {
            // Re-add old columns
            $table->string('cruise_line', 150)->nullable();
            $table->string('ship_name', 150)->nullable();
            $table->string('category', 100)->nullable();
            $table->string('stateroom', 100)->nullable();

            // Drop new columns
            $table->dropColumn(['day', 'type']);
        });
    }
};
