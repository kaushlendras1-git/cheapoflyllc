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
        Schema::create('call_logs', function (Blueprint $table) {
            $table->id();
            $table->boolean('chkflight')->default(false);
            $table->boolean('chkhotel')->default(false);
            $table->boolean('chkcruise')->default(false);
            $table->boolean('chkcar')->default(false);
            $table->string('phone');
            $table->string('name');
            $table->string('team');
            $table->string('campaign');
            $table->string('reservation_source');
            $table->string('call_type');
            $table->boolean('call_converted')->default(false);
            $table->timestamp('followup_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_logs');
    }
};
