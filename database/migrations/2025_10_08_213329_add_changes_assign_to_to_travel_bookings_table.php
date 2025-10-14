<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('travel_bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('changes_assign_to')->nullable()->after('query_type');
            $table->foreign('changes_assign_to')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('travel_bookings', function (Blueprint $table) {
            $table->dropForeign(['changes_assign_to']);
            $table->dropColumn('changes_assign_to');
        });
    }
};