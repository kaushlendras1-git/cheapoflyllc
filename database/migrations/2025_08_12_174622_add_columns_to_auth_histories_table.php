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
        Schema::table('auth_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('booking_id')->after('id')->nullable();
            $table->unsignedBigInteger('billing_details_id')->after('booking_id')->nullable();
            $table->unsignedBigInteger('travel_billing_details_id')->after('billing_details_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('auth_histories', function (Blueprint $table) {
            //
        });
    }
};
