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
            $table->decimal('gross_mco', 10, 2)->nullable()->after('net_value');
            $table->decimal('net_mco', 10, 2)->nullable()->after('gross_mco');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('travel_bookings', function (Blueprint $table) {
            $table->dropColumn(['gross_mco', 'net_mco']);
        });
    }
};
