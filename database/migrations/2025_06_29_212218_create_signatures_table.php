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
       Schema::create('signatures', function (Blueprint $table) {
        $table->id();
        $table->text('signature_data'); // To store signature as text (image URL or base64)
        $table->ipAddress('ip_address');
        $table->string('signature_type')->default('draw'); // "draw" or "type"
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signatures');
    }
};
