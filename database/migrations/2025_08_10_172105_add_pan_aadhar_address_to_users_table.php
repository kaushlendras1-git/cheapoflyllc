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
        Schema::table('users', function (Blueprint $table) {
            $table->string('pan_card')->nullable()->after('email'); // store file path
            $table->string('aadhar_card')->nullable()->after('pan_card'); // store file path
            $table->text('address')->nullable()->after('aadhar_card');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
             $table->dropColumn(['pan_card', 'aadhar_card', 'address']);
        });
    }
};
