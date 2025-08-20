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
       Schema::table('travel_billing_details', function (Blueprint $table) {
            $table->dropColumn(['zip_code', 'country', 'city', 'contact_no', 'email', 'address']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('travel_billing_details', function (Blueprint $table) {
            $table->string('zip_code')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
        });
    }
};
