<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('log_type'); // 'call_log', 'booking'
            $table->unsignedBigInteger('resource_id'); // ID of the resource being logged
            $table->string('action'); // 'view', 'create', 'edit', 'delete'
            $table->text('message'); // Descriptive message
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            
            $table->index(['log_type', 'resource_id']);
            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};