<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCampaignToCampaignIdInCallLogs extends Migration
{
    public function up()
    {
        Schema::table('call_logs', function (Blueprint $table) {
            // Use the correct foreign key name
            $table->dropForeign('call_logs_campaign_id_foreign');
            $table->renameColumn('campaign', 'campaign_id');
            $table->foreign('campaign_id')
                  ->references('id')
                  ->on('campaigns')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('call_logs', function (Blueprint $table) {
            $table->dropForeign(['campaign_id']);
            $table->renameColumn('campaign_id', 'campaign');
            $table->foreign('campaign')
                  ->references('id')
                  ->on('campaigns')
                  ->name('call_logs_campaign_id_foreign') // Ensure same name on rollback
                  ->onDelete('set null')
                  ->onUpdate('cascade');
        });
    }
}