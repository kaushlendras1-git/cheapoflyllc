<?php
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Reports\CampaignCallsReportController;
use App\Http\Controllers\Reports\RevenueReportController;

Route::middleware('auth')->group(function () {
    Route::prefix('reports')->group(function () {
        Route::get('marketing', [ReportController::class,'marketing'])->name('marketing');
        Route::get('call_queue', [ReportController::class,'call_queue'])->name('call_queue');
        Route::get('agents', [ReportController::class,'agents'])->name('agents');
        Route::get('score', [ReportController::class,'score'])->name('score');
        Route::get('campaign-calls', [CampaignCallsReportController::class, 'index'])->name('reports.campaign-calls');
        Route::get('revenue', [RevenueReportController::class, 'index'])->name('reports.revenue');
    });
  });

