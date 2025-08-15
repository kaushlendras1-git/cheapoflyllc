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
            Schema::create('booking_status_dependencies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_status_id');
            $table->unsignedBigInteger('dependent_status_id');
            $table->string('department')->nullable();
            $table->string('role')->nullable();

            // Foreign keys
            $table->foreign('booking_status_id')->references('id')->on('booking_statuses')->onDelete('cascade');
            $table->foreign('dependent_status_id')->references('id')->on('booking_statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_status_dependencies');
    }
};
