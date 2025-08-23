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
            $table->integer('call_type')->nullable()->after('id'); // Add call_type as INT, nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('travel_bookings', function (Blueprint $table) {
            $table->dropColumn('call_type'); // Remove call_type column on rollback
        });
    }
};
