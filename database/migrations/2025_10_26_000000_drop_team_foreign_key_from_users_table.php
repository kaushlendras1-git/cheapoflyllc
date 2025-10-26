<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['team']);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('team')->references('id')->on('teams')->onDelete('set null');
        });
    }
};