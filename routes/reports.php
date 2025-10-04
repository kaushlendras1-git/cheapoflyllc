<?php
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Reports\CampaignCallsReportController;
use App\Http\Controllers\Reports\RevenueReportController;
use App\Http\Controllers\Reports\TeamReportController;
use App\Http\Controllers\Reports\UnitReportController;
use App\Http\Controllers\Reports\CompanyReportController;

Route::middleware('auth')->group(function () {
    Route::prefix('reports')->group(function () {
        Route::get('marketing', [ReportController::class,'marketing'])->name('marketing');
        Route::get('call_queue', [ReportController::class,'call_queue'])->name('call_queue');
        Route::get('agents', [ReportController::class,'agents'])->name('agents');
        Route::get('score', [ReportController::class,'score'])->name('score');
        Route::get('campaign-calls', [CampaignCallsReportController::class, 'index'])->name('reports.campaign-calls');
        Route::get('revenue', [RevenueReportController::class, 'index'])->name('reports.revenue');
        Route::get('team', [TeamReportController::class, 'index'])->name('reports.team');
        Route::get('unit', [UnitReportController::class, 'index'])->name('reports.unit');
        Route::get('company', [CompanyReportController::class, 'index'])->name('reports.company');
    });
  });

