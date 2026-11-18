<?php
namespace Applab\LaravelSms;
use Illuminate\Support\ServiceProvider;
class LaravelSmsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/applab-config.php'=>config_path('applab-sms.php')
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/applab-config.php', 'applab-sms');
        $this->app->bind('applabsms',function ($app){
            return new ApplabSms();
        });
    }
}
