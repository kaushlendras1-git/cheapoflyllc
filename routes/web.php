<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CallLogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailTemplateController;

use App\Http\Controllers\CountryStateController;
#use App\Http\Controllers\CallBackController;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AuthHistoryController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\LOBController;




// use App\Http\Controllers\Travel\TravelBookingController;
// use App\Http\Controllers\Travel\TravelBookingTypeController;
// use App\Http\Controllers\Travel\TravelSectorDetailController;
// use App\Http\Controllers\Travel\TravelPassengerController;
// use App\Http\Controllers\Travel\TravelBillingDetailController;
// use App\Http\Controllers\Travel\TravelPricingDetailController;
// use App\Http\Controllers\Travel\TravelBookingRemarkController;
// use App\Http\Controllers\Travel\TravelQualityFeedbackController;
// use App\Http\Controllers\Travel\TravelScreenshotController;


use App\Http\Controllers\Auth\AuthEmailController;
use App\Http\Controllers\MailHistoryController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\FcmController;

Route::post('/fcm/token', [FcmController::class, 'store'])->middleware('auth'); // or guestable

Route::get('/mail-sent',[AuthEmailController::class,'index']);

Route::get('/statelist/{id}',[CountryStateController::class,'state'])->name('statelist');
Route::get('/countrylist',[CountryStateController::class,'country'])->name('countrylist');


Route::get('/i_authorized/{booking_id}/{card_id}/{card_billing_id}', [SignatureController::class, 'showForm'])->name('i_authorized');

Route::post('/signature', [SignatureController::class, 'store'])->name('signature.store');
Route::get('/signatures', [SignatureController::class, 'list'])->name('signature.list');




Route::get('/send-test-email', function () {
    Mail::to('recipient@example.com')->send(new TestEmail());
    return 'Test email sent!';
});


Route::post('/send-notification', [NotificationController::class, 'sendNotification']);
Route::post('/update-device-token', [NotificationController::class, 'updateDeviceToken']);

/**Booking **/


Route::get('/booking-information-next', function () {return view('web.booking-information-next');})->name('booking-information-next');

Route::get('/', function () {return view('web.login');});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {

//    Route::post('/travel/bookings/submit', [BookingFormController::class, 'store'])->name('travel.bookings.submit');
//    Route::get('/travel/bookings/edit/{id}', [BookingFormController::class, 'edit'])->name('travel.bookings.edit');

    Route::prefix('booking')->name('booking.')->group(function () {
//        Route::resource('online-booking', OnlineBookingController::class);
//        Route::post('/billing-details/{id}', [BookingFormController::class, 'billingDetails'])->name('billing-details');
//        Route::get('/billing-details/{id}', [BookingFormController::class, 'getBillingDetails'])->name('billing-details');
//        Route::delete('/billing-details/{id}', [BookingFormController::class, 'deletebillingDetails'])->name('billing-details.destroy');
//        Route::post('/update-remark/{id}',[BookingFormController::class,'updateRemark'])->name('update-remark');
//        Route::post('/delete-remark/{id}',[BookingFormController::class,'deleteRemark'])->name('delete-remark');
//        Route::post('/status-remark/{id}', [BookingFormController::class, 'toggleRemarkStatus'])->name('status-remark');
//        Route::post('/update-feedback/{id}',[BookingFormController::class,'updateFeedBack'])->name('update-feedback');
//        Route::post('/delete-feedback/{id}',[BookingFormController::class,'deleteFeedBack'])->name('delete-feedback');
//        Route::get('/add', [BookingFormController::class, 'add'])->name('add');
//        Route::get('/search', [BookingFormController::class, 'search'])->name('search');
//        Route::get('/export', [BookingFormController::class, 'export'])->name('export');
//        Route::get('/', [BookingFormController::class, 'index'])->name('index');
//        Route::get('/{id}', [BookingFormController::class, 'show'])->name('show');
//        Route::patch('/update/{id}', [BookingFormController::class, 'update'])->name('update');


        Route::prefix('auth-email')->name('auth-email.')->group(function () {
            Route::post('index/{id}', [AuthEmailController::class, 'index'])->name('sendmail'); // this is correct
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
    });

    Route::resource('emails', EmailTemplateController::class);
    #Route::resource('call-back', CallBackController::class);
    Route::resource('follow-up', FollowUpController::class);

    Route::get('/forgot-password', function () {return view('web.forgot-password');})->name('forgot-password');

    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');


        /** Call Logs**/
        Route::resource('call-logs', CallLogController::class);
        Route::get('/supplier', function () {return view('web.supplier');})->name('supplier');
        Route::get('/quality', function () {return view('web.quality');})->name('quality');
        Route::get('/history', function () {return view('web.history');})->name('history');
        Route::get('/pricing-details', function () {return view('web.pricing-details');});
        Route::get('/auth-history/{id}', [AuthHistoryController::class, 'index'])->name('auth-history');
        Route::post('/sms/{id}', [AuthHistoryController::class, 'sendSms'])->name('sms');
        Route::get('/whatsup/{id}', [AuthHistoryController::class, 'sendWhatsApp'])->name('whatsup');
        Route::get('/survey/{id}', [SurveyController::class, 'index'])->name('survey');
    });

require __DIR__ . '/booking.php';
require __DIR__ . '/masters.php';
require __DIR__ . '/reports.php';
require __DIR__ . '/user.php';
