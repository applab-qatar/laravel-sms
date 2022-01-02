<?php
namespace Applab\LaravelSms\Facades;

use Illuminate\Support\Facades\Facade;

class ApplabSMS extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'ApplabSMS';
    }
}