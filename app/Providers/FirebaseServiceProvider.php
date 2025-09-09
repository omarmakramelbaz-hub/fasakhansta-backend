<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging;

class FirebaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('firebase.messaging', function ($app) {
            $factory = (new Factory)->withServiceAccount(config('firebase.credentials'));

            return $factory->createMessaging();
        });
    }

    public function boot()
    {
        //
    }
}
