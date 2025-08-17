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
            $table->string('gross_value');
            $table->string('net_value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('travel_bookings', function (Blueprint $table) {
            $table->dropColumn('gross_value');
            $table->dropColumn('net_value');
        });
    }
};
