<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('booking_statuses', function (Blueprint $table) {
            $table->json('departments')->nullable()->after('department');
            $table->json('roles')->nullable()->after('role');
        });
        
        Schema::table('payment_statuses', function (Blueprint $table) {
            $table->json('departments')->nullable()->after('department');
            $table->json('roles')->nullable()->after('role');
        });
    }

    public function down()
    {
        Schema::table('booking_statuses', function (Blueprint $table) {
            $table->dropColumn(['departments', 'roles']);
        });
        
        Schema::table('payment_statuses', function (Blueprint $table) {
            $table->dropColumn(['departments', 'roles']);
        });
    }
};