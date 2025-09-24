<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('status_interdependencies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_status_id');
            $table->unsignedBigInteger('payment_status_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('role_id');
            $table->enum('direction', ['booking_to_payment', 'payment_to_booking', 'bidirectional']);
            $table->timestamps();
            
            $table->foreign('booking_status_id')->references('id')->on('booking_statuses')->onDelete('cascade');
            $table->foreign('payment_status_id')->references('id')->on('payment_statuses')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            
            $table->unique(['booking_status_id', 'payment_status_id', 'department_id', 'role_id'], 'status_interdep_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('status_interdependencies');
    }
};