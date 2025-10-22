<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CallLogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\CountryStateController;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AuthHistoryController;
use App\Http\Controllers\SurveyController;

use App\Http\Controllers\FlightSearchListController;
use App\Http\Controllers\TrainSearchListController;
use App\Http\Controllers\PostController;

use App\Http\Controllers\MailHistoryController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\TeamLeaderDashboardController;

use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\FcmController;
use App\Http\Controllers\AgentLoginController;

use App\Http\Controllers\AirlineCodeController;
use App\Http\Controllers\Masters\BookingStatusController;
use App\Http\Controllers\Masters\PaymentStatusController;
use App\Http\Controllers\Masters\TeamController;
use App\Http\Controllers\Masters\StatusController;
use App\Http\Controllers\Masters\SupplierController;
use App\Http\Controllers\Masters\QualityController;
use App\Http\Controllers\Masters\QueryTypeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\Masters\CompaniesController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Masters\DepartmentController;
use App\Http\Controllers\Masters\RoleController;
use App\Http\Controllers\Masters\LOBController;
use App\Http\Controllers\Masters\UnitController;
use App\Http\Controllers\RingCentral\RingCentralController;



Route::post('/fcm/token', [FcmController::class, 'store'])->middleware('auth'); // or guestable

// RingCentral OAuth Callback
Route::get('/auth/ringcentral/callback', [RingCentralController::class, 'callback'])->name('auth.ringcentral.callback');

// Agent Login Request Routes (no auth required)
Route::post('/agent/request-login', [AgentLoginController::class, 'requestLogin'])->name('agent.request-login');
Route::get('/agent/check-request-status/{email}', [AgentLoginController::class, 'checkRequestStatus'])->name('agent.check-request-status');

// Agent Login Request Routes (auth required)
Route::middleware('auth')->prefix('agent')->group(function () {
    Route::post('/login-approval/{id}', [AgentLoginController::class, 'approveRequest'])->name('agent.login-approval');
    Route::get('/pending-requests', [AgentLoginController::class, 'getPendingRequests'])->name('agent.pending-requests');
    Route::get('/admin-notifications', [AgentLoginController::class, 'getAdminNotifications'])->name('agent.admin-notifications');
    Route::post('/cleanup-expired', [AgentLoginController::class, 'cleanupExpiredRequests'])->name('agent.cleanup-expired');
    Route::get('/test-notifications', [AgentLoginController::class, 'testNotifications'])->name('agent.test-notifications');
});
Route::get('/agent/auto-login/{id}', [AgentLoginController::class, 'autoLogin'])->name('agent.auto-login');
Route::get('/statelist/{id}',[CountryStateController::class,'state'])->name('statelist');
Route::get('/countrylist',[CountryStateController::class,'country'])->name('countrylist');

// API Routes
Route::middleware('auth')->get('/api/payment-statuses-by-booking', [App\Http\Controllers\Api\StatusController::class, 'getPaymentStatusesByBooking']);

/***** Auth **** */
Route::get('/i_authorized/{booking_id}/{card_id}/{card_billing_id}/{refund_status}', [SignatureController::class, 'showForm'])->name('i_authorized');
Route::get('/i_authorized_pdf/{booking_id}/{card_id}/{card_billing_id}/{refund_status}', [SignatureController::class, 'pdf'])->name('i_authorized_pdf');
Route::post('/signature', [SignatureController::class, 'store'])->name('signature.store');
Route::get('/signatures', [SignatureController::class, 'list'])->name('signature.list');
Route::post('/mail-sent',[\App\Http\Controllers\Auth\AuthEmailController::class,'index'])->name('mail-sent');
// Notification Routes
Route::post('/send-notification', [NotificationController::class, 'sendNotification']);
Route::post('/update-device-token', [NotificationController::class, 'updateDeviceToken']);

// web.php
Route::get('/search-airline', [FlightSearchListController::class, 'search'])->name('airline.search');
Route::get('/search-train', [TrainSearchListController::class, 'search'])->name('train.search');
Route::get('/search-airlines_code', [AirlineCodeController::class, 'search'])->name('airlines_code.search');
Route::get('/api/cruise-ports', [\App\Http\Controllers\CruisePortController::class, 'getCruisePorts'])->name('cruise-ports.api');

/**Booking **/


Route::get('/booking-information-next', function () {return view('web.booking-information-next');})->name('booking-information-next');

Route::get('/', function () {return view('web.login');});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Settings route
Route::get('/settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('settings');

Route::middleware('auth')->group(function () {


    Route::prefix('booking')->name('booking.')->group(function () {
        Route::prefix('auth-email')->name('auth-email.')->group(function () {
            Route::post('index/{id}', [\App\Http\Controllers\Auth\AuthEmailController::class, 'index'])->name('sendmail'); // this is correct
        });
        Route::prefix('mail')->name('mail.')->group(function () {
            Route::get('/history/index/{id}', [MailHistoryController::class, 'index'])->name('history.index');
        });


    });

    Route::prefix('reports')->group(function () {
        Route::get('marketing', [ReportController::class,'marketing'])->name('marketing');
        Route::get('call_queue', [ReportController::class,'call_queue'])->name('call_queue');
        Route::get('agents', [ReportController::class,'agents'])->name('agents');
        Route::get('score', [ReportController::class,'score'])->name('score');
    });

    Route::prefix('masters')->group(function () {
        Route::resource('booking-status', BookingStatusController::class);
        Route::resource('payment-status', PaymentStatusController::class);
        Route::resource('call-types', CallTypeController::class);
        Route::resource('campaign', CampaignController::class);
        Route::resource('quality-feedback', QualityFeedbackController::class);
        Route::resource('lobs', LOBController::class);
        Route::resource('teams', TeamController::class);
        Route::resource('status', StatusController::class);
        Route::resource('supplier', SupplierController::class);
        Route::resource('quality', QualityController::class);
        Route::resource('query-type', QueryTypeController::class);
        Route::resource('members', MemberController::class);
        Route::resource('companies', CompaniesController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('units', UnitController::class);
    });



    Route::resource('emails', EmailTemplateController::class);
    #Route::resource('call-back', CallBackController::class);
    Route::resource('follow-up', FollowUpController::class);

    Route::get('/forgot-password', function () {return view('web.forgot-password');})->name('forgot-password');

    Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/user-performance', [AdminDashboardController::class, 'userPerformance'])->name('admin.user-performance');
    Route::get('/admin/revenue-data', [AdminDashboardController::class, 'revenueData'])->name('admin.revenue-data');
    Route::get('/admin/queue-status', [AdminDashboardController::class, 'queueStatus'])->name('admin.queue-status');
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/admin/teamleader-dashboard', [TeamLeaderDashboardController::class, 'index'])->name('admin.teamleader-dashboard');
    Route::get('/score-details', [UserDashboardController::class, 'scoreDetails'])->name('score.details');


        /** Call Logs**/
        Route::resource('call-logs', CallLogController::class);
        Route::get('/supplier', function () {return view('web.supplier');})->name('supplier');
        Route::get('/quality', function () {return view('web.quality');})->name('quality');
        Route::get('/history', function () {return view('web.history');})->name('history');
        Route::get('/pricing-details', function () {return view('web.pricing-details');});
        Route::get('/auth-history/{id}', [AuthHistoryController::class, 'index'])->name('auth-history');
        Route::get('/download-auth-pdf/{id}', [AuthHistoryController::class, 'downloadAuthPdf'])->name('download-auth-pdf');
        Route::post('/sms/{id}', [AuthHistoryController::class, 'sendSms'])->name('sms');
        Route::get('/whatsup/{id}', [AuthHistoryController::class, 'sendWhatsApp'])->name('whatsup');
        Route::get('/survey/{id}', [SurveyController::class, 'index'])->name('survey');
        
        // Settings routes (moved outside)
        Route::put('/settings/profile', [\App\Http\Controllers\SettingsController::class, 'updateProfile'])->name('settings.profile.update');
        Route::put('/settings/password', [\App\Http\Controllers\SettingsController::class, 'updatePassword'])->name('settings.password.update');
        Route::put('/settings/documents', [\App\Http\Controllers\SettingsController::class, 'updateDocuments'])->name('settings.documents.update');
        
        // Profile route
        Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
        
        // Attendance routes
        Route::get('/attendance', [\App\Http\Controllers\AttendanceController::class, 'index'])->name('attendance.index');
        Route::post('/attendance', [\App\Http\Controllers\AttendanceController::class, 'store'])->name('attendance.store');
        Route::put('/attendance/{id}', [\App\Http\Controllers\AttendanceController::class, 'update'])->name('attendance.update');
        Route::get('/attendance/export', [\App\Http\Controllers\AttendanceController::class, 'export'])->name('attendance.export');
    });

// API route for teams by LOB
Route::get('/api/teams/{lobId}', [\App\Http\Controllers\Masters\TeamController::class, 'getTeamsByLob']);


Route::get('/terms-and-conditions', function () {return view('terms.terms-and-conditions');})->name('terms-and-conditions');

// Flydreamz Routes
    Route::get('/flydreamz/terms-and-conditions/refundable', function () { return view('terms.flydreamz_refundable'); })->name('flydreamz.terms.refundable');
    Route::get('/flydreamz/terms-and-conditions/nonrefundable', function () { return view('terms.flydreamz_nonrefundable');})->name('flydreamz.terms.nonrefundable');

// FareticketsUS Routes
    Route::get('/fareticketsus/terms-and-conditions/refundable', function () { return view('terms.fareticketsus_refundable');})->name('fareticketsus.terms.refundable');
    Route::get('/fareticketsus/terms-and-conditions/nonrefundable', function () { return view('terms.fareticketsus_nonrefundable');})->name('fareticketsus.terms.nonrefundable');


require __DIR__ . '/booking.php';
require __DIR__ . '/masters.php';
require __DIR__ . '/reports.php';
require __DIR__ . '/user.php';
require __DIR__ . '/ringcentral.php';
require __DIR__ . '/zoho-sign.php';

