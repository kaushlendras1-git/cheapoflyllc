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
            $table->string('card_last_digit', 4)->nullable()->after('booking_id');
        });

        Schema::table('signatures', function (Blueprint $table) {
            $table->string('card_last_digit', 4)->nullable()->after('booking_id'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('auth_histories', function (Blueprint $table) {
            $table->dropColumn('card_last_digit');
        });

        Schema::table('signatures', function (Blueprint $table) {
            $table->dropColumn('card_last_digit');
        });
    }
};
