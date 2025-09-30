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
        Schema::table('travel_passengers', function (Blueprint $table) {
            $table->string('room_category')->nullable()->after('e_ticket_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('travel_passengers', function (Blueprint $table) {
            $table->dropColumn('room_category');
        });
    }
};
