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
        Schema::create('booking_payment_statuses', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('booking_status_id'); // Foreign key for booking status
            $table->unsignedBigInteger('payment_status_id'); // Foreign key for payment status
            $table->string('department'); // Department field as a string
            $table->timestamps(); // Adds created_at and updated_at columns

            // Foreign key constraints
            $table->foreign('booking_status_id')
                  ->references('id')
                  ->on('booking_statuses')
                  ->onDelete('cascade'); // Cascade on delete to remove related records
            $table->foreign('payment_status_id')
                  ->references('id')
                  ->on('payment_statuses')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_payment_statuses');
    }
};
