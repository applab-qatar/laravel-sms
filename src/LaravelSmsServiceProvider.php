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
        $this->app->singleton(LaravelSms::class,function (){
            return new LaravelSms();
        });
    }
}
