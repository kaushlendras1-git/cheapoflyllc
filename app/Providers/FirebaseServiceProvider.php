<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;

class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
         $this->app->singleton(\Kreait\Firebase\Contract\Auth::class, function ($app) {
            $factory = (new Factory)->withServiceAccount(config('firebase.credentials.file'));
            return $factory->createAuth();
        });

        $this->app->singleton(\Kreait\Firebase\Contract\Database::class, function ($app) {
            $factory = (new Factory)->withServiceAccount(config('firebase.credentials.file'));
            return $factory->createDatabase();
        });

        $this->app->singleton(\Kreait\Firebase\Contract\Messaging::class, function ($app) {
            $factory = (new Factory)->withServiceAccount(config('firebase.credentials.file'));
            return $factory->createMessaging();
        });
    }

}
