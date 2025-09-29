<?php
use App\Http\Controllers\Travel\BookingFormController;
use App\Http\Controllers\OnlineBookingController;

Route::middleware('auth')->group(function () {

    Route::prefix('booking')->name('booking.')->group(function () {

        Route::resource('online-booking', OnlineBookingController::class);

        Route::post('/billing-details/{id}', [BookingFormController::class, 'billingDetails'])->name('billing-details');
        Route::get('/billing-details/{id}', [BookingFormController::class, 'getBillingDetails'])->name('get-billing-details');
        Route::get('/billing-details/edit/{id}', [BookingFormController::class, 'editBillingDetails'])->name('billing-details.edit');
        Route::put('/billing-details/{id}', [BookingFormController::class, 'updateBillingDetails'])->name('billing-details.update');
        Route::delete('/billing-details/{id}', [BookingFormController::class, 'deletebillingDetails'])->name('billing-details.destroy');
        Route::post('/update-remark/{id}',[BookingFormController::class,'updateRemark'])->name('update-remark');
        Route::post('/delete-remark/{id}',[BookingFormController::class,'deleteRemark'])->name('delete-remark');
        Route::post('/status-remark/{id}', [BookingFormController::class, 'toggleRemarkStatus'])->name('status-remark');
        Route::post('/update-feedback/{id}',[BookingFormController::class,'updateFeedBack'])->name('update-feedback');
        Route::post('/delete-feedback/{id}',[BookingFormController::class,'deleteFeedBack'])->name('delete-feedback');
        Route::delete('/flight-image/{id}', [BookingFormController::class, 'deleteFlightImage'])->name('delete.flight.image');
        Route::delete('/hotel-image/{id}', [BookingFormController::class, 'deleteHotelImage'])->name('delete.hotel.image');
        Route::delete('/cruise-image/{id}', [BookingFormController::class, 'deleteCruiseImage'])->name('delete.cruise.image');
        Route::delete('/car-image/{id}', [BookingFormController::class, 'deleteCarImage'])->name('delete.car.image');
        Route::delete('/train-image/{id}', [BookingFormController::class, 'deleteTrainImage'])->name('delete.train.image');
        Route::get('/add', [BookingFormController::class, 'add'])->name('add');
        Route::get('/search', [BookingFormController::class, 'search'])->name('search');
        Route::get('/export', [BookingFormController::class, 'export'])->name('export');
        Route::get('/', [BookingFormController::class, 'index'])->name('index');
        Route::get('/{id}', [BookingFormController::class, 'show'])->name('show');
        Route::patch('/update/{id}', [BookingFormController::class, 'update'])->name('update');
        Route::post('save-billing-field/{id}',[BookingFormController::class,'saveBillingField'])->name('newField');

        Route::prefix('auth-email')->name('auth-email.')->group(function () {
            Route::post('index/{id}', [\App\Http\Controllers\Auth\AuthEmailController::class, 'index'])->name('sendmail');
        });
        Route::prefix('mail')->name('mail.')->group(function () {
            Route::get('/history/index/{id}', [\App\Http\Controllers\MailHistoryController::class, 'index'])->name('history.index');
        });
    });


    Route::post('/travel/bookings/submit', [BookingFormController::class, 'store'])->name('travel.bookings.submit');
    Route::get('/travel/bookings/edit/{id}', [BookingFormController::class, 'edit'])->name('travel.bookings.edit');



});
