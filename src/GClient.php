<?php


namespace Applab\LaravelSms;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class GClient extends Client
{
    protected $client;
    public $bearerToken;
    public function __construct()
    {
        $this->client=new Client([
            'base_uri'=>"https://sms.applab.qa/api/".config('applab-sms.api-version').'/'
        ]);
        return $this->client;
    }
}
