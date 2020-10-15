<?php

namespace App\Providers;

use App\Libs\SmsNotifier\SmsContract;
use App\Libs\SmsNotifier\Twilio;
use Illuminate\Support\ServiceProvider;

class SMSProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SmsContract::class, function() {
            return new Twilio();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
