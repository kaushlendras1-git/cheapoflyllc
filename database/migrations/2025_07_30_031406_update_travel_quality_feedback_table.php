<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTravelQualityFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('travel_quality_feedback', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn(['qa', 'status', 'feedback', 'parameters']);

            // Add new columns
            $table->string('parameter')->nullable();
            $table->text('note')->nullable();
            $table->string('marks')->nullable();
            $table->string('quality')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('travel_quality_feedback', function (Blueprint $table) {
            // Add the old columns back
            $table->string('qa')->nullable();
            $table->string('status')->nullable();
            $table->text('feedback')->nullable();
            $table->json('parameters')->nullable();

            // Remove the new columns
            $table->dropColumn(['parameter', 'note', 'marks', 'quality']);
        });
    }
}
