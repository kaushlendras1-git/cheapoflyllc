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
        Schema::table('travel_pricing_details', function (Blueprint $table) {
            $table->string('num_passengers');
            $table->string('gross_price');
            $table->string('net_price');
            $table->string('details');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('travel_pricing_details', function (Blueprint $table) {
            $table->dropColumn('num_passengers');
            $table->dropColumn('gross_price');
            $table->dropColumn('net_price');
            $table->dropColumn('details');
        });
    }
};
