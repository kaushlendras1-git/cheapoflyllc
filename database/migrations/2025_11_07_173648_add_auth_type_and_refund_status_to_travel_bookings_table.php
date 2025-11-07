<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('travel_bookings', function (Blueprint $table) {
            $table->string('auth_type')->nullable()->after('changes_assign_to');
            $table->string('refund_status')->nullable()->after('auth_type');
        });
    }

    public function down()
    {
        Schema::table('travel_bookings', function (Blueprint $table) {
            $table->dropColumn(['auth_type', 'refund_status']);
        });
    }
};