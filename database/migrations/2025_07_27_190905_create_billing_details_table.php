<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('billing_details')) {
            Schema::create('billing_details', function (Blueprint $table) {
                $table->id();
                $table->string('email');
                $table->string('contact_number', 10);
                $table->string('street_address');
                $table->string('city');
                $table->string('state');
                $table->string('zip_code', 6);
                $table->string('country');
                $table->unsignedBigInteger('booking_id');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_details');
    }
};
