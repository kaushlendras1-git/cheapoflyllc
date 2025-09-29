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
            $table->text('price_description')->nullable()->after('details'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('travel_pricing_details', function (Blueprint $table) {
            $table->dropColumn('price_description');
        });
    }
};
