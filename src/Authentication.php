<?php


namespace Applab\LaravelSms;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;

class Authentication extends GClient
{

    //authenticate the app api user for all requests
    public function login()
    {
        try{
            if(config('applab-sms.username')!='' && config('applab-sms.password')!='') {
                $body = ['email' => config('applab-sms.username'),
                    'password' => config('applab-sms.password')];

                $response = $this->client->request('POST', 'login', [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Accept-Language'=>app()->getLocale()
                    ],
                    'form_params' => $body
                ]);
                if($response->getBody()){
                    $response=json_decode($response->getBody());
                    if($response->token){
                        Cache::put('applab-sms-btoken', $response->token, (60*24*7));
                        return true;
                    }
                }
                throw new \Exception("Auth Token creation failed");
            }else{
                throw new \Exception('Invalid input!, Ensure configuration values are correct');
            }
        }catch(GuzzleException $e){
            throw $e;
        }
    }
}
