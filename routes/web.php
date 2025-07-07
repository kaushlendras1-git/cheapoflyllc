<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Masters\StatusController;
use App\Http\Controllers\Masters\SupplierController;
use App\Http\Controllers\Masters\QualityController;
use App\Http\Controllers\Masters\TeamController;
use App\Http\Controllers\Masters\CampaignController;
use App\Http\Controllers\Masters\CallTypeController;
use App\Http\Controllers\Masters\QualityFeedbackController;
use App\Http\Controllers\Masters\QueryTypeController;
use App\Http\Controllers\Masters\BookingStatusController;
use App\Http\Controllers\Masters\PaymentStatusController;
use App\Http\Controllers\Masters\CompaniesController;
use App\Http\Controllers\CallLogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CountryStateController;
#use App\Http\Controllers\CallBackController;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AuthHistoryController;
use App\Http\Controllers\SurveyController;

// use App\Http\Controllers\Travel\TravelBookingController;
// use App\Http\Controllers\Travel\TravelBookingTypeController;
// use App\Http\Controllers\Travel\TravelSectorDetailController;
// use App\Http\Controllers\Travel\TravelPassengerController;
// use App\Http\Controllers\Travel\TravelBillingDetailController;
// use App\Http\Controllers\Travel\TravelPricingDetailController;
// use App\Http\Controllers\Travel\TravelBookingRemarkController;
// use App\Http\Controllers\Travel\TravelQualityFeedbackController;
// use App\Http\Controllers\Travel\TravelScreenshotController;

use App\Http\Controllers\Travel\BookingFormController;
use App\Http\Controllers\Auth\AuthEmailController;
#use App\Http\Controllers\Auth\MailHistoryController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\SignatureController;

Route::get('/statelist/{id}',[CountryStateController::class,'state'])->name('statelist');
Route::get('/countrylist',[CountryStateController::class,'country'])->name('countrylist');




Route::get('/signature', [SignatureController::class, 'showForm'])->name('signature.form');
Route::post('/signature', [SignatureController::class, 'store'])->name('signature.store');
Route::get('/signatures', [SignatureController::class, 'list'])->name('signature.list');


Route::get('/send-test-email', function () {
    Mail::to('recipient@example.com')->send(new TestEmail());
    return 'Test email sent!';
});


Route::post('/send-notification', [NotificationController::class, 'sendNotification']);
Route::post('/update-device-token', [NotificationController::class, 'updateDeviceToken']);

/**Booking **/
Route::post('/travel/bookings/submit', [BookingFormController::class, 'store'])->name('travel.bookings.submit');


Route::get('/', function () {return view('web.login');});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// <a href="{{ route('auth-email.index', ['id' => $id]) }}">Link Text</a>

// Route::prefix('travel')->group(function () {
//     Route::post('/bookings', [TravelBookingController::class, 'add']);
//     Route::put('/bookings/{id}', [TravelBookingController::class, 'update']);
//     Route::post('/booking-types', [TravelBookingTypeController::class, 'add']);
//     Route::put('/booking-types/{id}', [TravelBookingTypeController::class, 'update']);
//     Route::post('/sector-details', [TravelSectorDetailController::class, 'add']);
//     Route::put('/sector-details/{id}', [TravelSectorDetailController::class, 'update']);
//     Route::post('/passengers', [TravelPassengerController::class, 'add']);
//     Route::put('/passengers/{id}', [TravelPassengerController::class, 'update']);
//     Route::post('/billing-details', [TravelBillingDetailController::class, 'add']);
//     Route::put('/billing-details/{id}', [TravelBillingDetailController::class, 'update']);
//     Route::post('/pricing-details', [TravelPricingDetailController::class, 'add']);
//     Route::put('/pricing-details/{id}', [TravelPricingDetailController::class, 'update']);
//     Route::post('/booking-remarks', [TravelBookingRemarkController::class, 'add']);
//     Route::put('/booking-remarks/{id}', [TravelBookingRemarkController::class, 'update']);
//     Route::post('/quality-feedback', [TravelQualityFeedbackController::class, 'add']);
//     Route::put('/quality-feedback/{id}', [TravelQualityFeedbackController::class, 'update']);
//     Route::post('/screenshots', [TravelScreenshotController::class, 'add']);
//     Route::put('/screenshots/{id}', [TravelScreenshotController::class, 'update']);
// });


Route::middleware('auth')->group(function () {

    Route::prefix('reports')->group(function () {
        Route::get('marketing', [ReportController::class,'marketing'])->name('marketing');
        Route::get('call_queue', [ReportController::class,'call_queue'])->name('call_queue');
        Route::get('agents', [ReportController::class,'agents'])->name('agents');
        Route::get('score', [ReportController::class,'score'])->name('score');
    });


    Route::prefix('masters')->group(function () {
        Route::resource('call-types', CallTypeController::class);
        Route::resource('teams', TeamController::class);
        Route::resource('campaign', CampaignController::class);
        Route::resource('status', StatusController::class);
        Route::resource('supplier', SupplierController::class);
        Route::resource('quality', QualityController::class);
        Route::resource('quality-feedback', QualityFeedbackController::class);
        Route::resource('query-type', QueryTypeController::class);
        Route::resource('booking-status', BookingStatusController::class);
        Route::resource('payment-status', PaymentStatusController::class);
        Route::resource('members', MemberController::class);
        Route::resource('companies', CompaniesController::class);
    });

    Route::resource('emails', EmailTemplateController::class);
    #Route::resource('call-back', CallBackController::class);
    Route::resource('follow-up', FollowUpController::class);

Route::get('/forgot-password', function () {return view('web.forgot-password');})->name('forgot-password');
Route::get('/dashboard', function () {return view('web.dashboard');})->name('dashboard');

/**Booking **/
Route::get('/booking-information', function () {return view('web.booking-information');})->name('booking-information');
Route::get('/booking-information-next', function () {return view('web.booking-information-next');})->name('booking-information-next');
Route::get('/booking', function () {return view('web.booking-listing');})->name('booking');


    /** Call Logs**/
    Route::resource('call-logs', CallLogController::class);

    Route::get('/supplier', function () {return view('web.supplier');})->name('supplier');
    Route::get('/quality', function () {return view('web.quality');})->name('quality');
    Route::get('/history', function () {return view('web.history');})->name('history');

    /** Users**/
    Route::get('/users', [MemberController::class, 'index'])->name('users');
    Route::patch('/members/{member}/status', [MemberController::class, 'updateStatus'])->name('members.updateStatus');

    Route::get('/pricing-details', function () {return view('web.pricing-details');});
    
    Route::get('/auth-history/{id}', [AuthHistoryController::class, 'authHistory'])->name('auth-history');
    Route::post('/sms/{id}', [AuthHistoryController::class, 'sendSms'])->name('sms');
    Route::get('/whatsup/{id}', [AuthHistoryController::class, 'sendWhatsApp'])->name('whatsup');
    Route::get('/survey/{id}', [SurveyController::class, 'index'])->name('survey');

});
