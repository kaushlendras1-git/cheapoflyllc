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
        Schema::table('signatures', function (Blueprint $table) {
            // Add new columns
            $table->unsignedBigInteger('card_id')->after('id');
            $table->unsignedBigInteger('card_billing_id')->after('card_id');
            $table->tinyInteger('refund_status')->default(1)->after('card_billing_id');

            // Drop old column
            $table->dropColumn('card_last_digit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('signatures', function (Blueprint $table) {
            // Rollback new columns
            $table->dropColumn(['card_id', 'card_billing_id', 'refund_status']);

            // Add back the removed column
            $table->integer('card_last_digit')->nullable();
        });
    }
};
