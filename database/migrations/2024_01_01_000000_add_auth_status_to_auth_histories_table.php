<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('auth_histories', function (Blueprint $table) {
            $table->string('auth_status')->nullable()->after('zoho_document_id');
        });
    }

    public function down()
    {
        Schema::table('auth_histories', function (Blueprint $table) {
            $table->dropColumn('auth_status');
        });
    }
};