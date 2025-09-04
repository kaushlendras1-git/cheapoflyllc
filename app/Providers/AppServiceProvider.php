<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\GenericChangeObserver;
use App\Models\TravelBooking;
use App\Models\TravelBookingType;
use App\Models\TravelPassenger;
use App\Models\TravelFlightDetail;
use App\Models\TravelHotelDetail;
use App\Models\TravelCruiseDetail;
use App\Models\TravelCarDetail;
use App\Models\TravelTrainDetail;
use App\Models\TravelBillingDetail;
use App\Models\TravelPricingDetail;
use App\Models\TravelSectorDetail;
use App\Models\User;
use App\Observers\UserObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $models = [
            TravelBooking::class,
            TravelBookingType::class,
            TravelPassenger::class,
            TravelFlightDetail::class,
            TravelHotelDetail::class,
            TravelCruiseDetail::class,
            TravelCarDetail::class,
            TravelTrainDetail::class,
            TravelBillingDetail::class,
            TravelPricingDetail::class,
            TravelSectorDetail::class
        ];

        foreach ($models as $model) {
            $model::observe(GenericChangeObserver::class);
        }
        
        User::observe(UserObserver::class);
    }
}
