<?php

namespace Applab\LaravelSms;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class LaravelSms
{
    public $bearerToken;
    public $secretKey;
    public static $client;
    public function __construct()
    {
        $this->bearerToken="1|jPa1Wf3lNSuDe9YTO65H1FFnoOPVcRtCvnLvqRl2";
        $this->secretKey=config('applab-sms.secret-key');
        self::$client=new Client([
            'base_uri'=>"https://sms.applab.qa/api/".config('applab-sms.version')
        ]);
    }
    public static function login()
    {
        try{
            $body=['email'=>config('applab-sms.username'),
                'password'=>config('applab-sms.password')];
            $response=self::$client->request('POST','/login',[
                'headers'=>[
                    'Accept'=>'application/json',
                ],
                $body
            ]);
            Cache::put('applab-sms-btoken', $response->token, 3600);
            return $response->token;
        }catch(GuzzleException $e){
            return response()->json([
                'error_code'=>$e->getCode(),
                'error_message'=>$e->getMessage()
            ],500);
        }
    }

    public static function otpSend()
    {
        try{
            if(!Cache::has('applab-sms-btoken') || !Cache::get('applab-sms-btoken')){
                self::$bearerToken=self::login();
            }else{
                self::$bearerToken=Cache::get('applab-sms-btoken');
            }
            $response=self::$client->request('POST','/2fa/send',[
                'headers'=>[
                    'Authorization'=>"Bearer ".self::bearerToken,
                    'Accept'=>'application/json',
                    'secretKey'=>self::secretKey,
                ]
            ]);
            return $response;
        }catch(GuzzleException $e){
            return response()->json([
                'error_code'=>$e->getCode(),
                'error_message'=>$e->getMessage()
            ],500);
        }
    }

    public static function otpReSend()
    {

    }
    public static function otpVerify()
    {

    }

    public static function sendSingleMessage()
    {

    }
}
