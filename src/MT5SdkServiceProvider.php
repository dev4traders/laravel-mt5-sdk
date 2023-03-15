<?php

namespace D4T\MT5Sdk;

use D4T\MT5Sdk\Manager;
use Illuminate\Support\ServiceProvider;

class MT5SdkServiceProvider extends ServiceProvider
{

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/mt5-sdk.php' => config_path('mt5-sdk.php'),
            ], 'config');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/mt5-sdk.php', 'mt5-sdk');

        $this->app->bind(Manager::class, function () {
            if (config('mt5-sdk.manager.api_token') === null) {
                return null;
            }

            if (config('mt5-sdk.manager.endpoint') === null) {
                return null;
            }

            return new Manager(
                config('mt5-sdk.manager.api_token'),
                config('mt5-sdk.manager.endpoint'),
            );
        });

    }
}