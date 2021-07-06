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
        $this->loadRoutesFrom(__DIR__ . '/routes' . '/web.php');
    }

    public function register()
    {
        $this->app->singleton(LaravelSms::class,function (){
            return new LaravelSms();
        });
    }
}
