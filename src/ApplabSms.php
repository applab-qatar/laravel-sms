<?php

namespace Applab\LaravelSms;

use Exception;
use Illuminate\Support\Facades\Cache;

class ApplabSms
{
    public $authClass;
    public static $bearerToken;
    public static $apiKey;
    public static $client;
    public function __construct()
    {
        $this->authClass=new Authentication();
        if(!Cache::has('applab-sms-btoken') || empty(Cache::get('applab-sms-btoken'))){
            $this->authClass->login();
        }
        $this->otpClass=new OTPSms();
        $this->messageClass=new Message();
    }

    public function otpSend($receiver,$message_id,$lang='en')
    {
        try{
            if(strlen($receiver)==11 && !empty($message_id)){
                $body=[
                    'to'=>$receiver,
                    'language'=>$lang,
                    'message_id'=>$message_id
                ];
                $response= $this->otpClass->sendOtp($body);
                return json_decode($response);
            }else{
                throw new Exception('Invalid input!, Ensure receiver mobile number and message id is correct');
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function otpReSend($pin_id)
    {
        try {
            $body = [
                'pin_id' => $pin_id,
            ];
            $response= $this->otpClass->resend($body);
            return json_decode($response);
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function otpVerify($pin_id,$otp)
    {
        try {
            $body = [
                'pin_id' => $pin_id,
                'otp' => $otp,
            ];
            $response= $this->otpClass->verify($body);
            return json_decode($response);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function singleMessage($receiver,$message)
    {
        try {
            if(strlen($receiver)==11 && !empty($message)) {
                $body = [
                    'to' => $receiver,
                    'text' => $message,
                ];
                $response= $this->messageClass->sendSingle($body);
                return json_decode($response);
            }else{
                throw new Exception('Invalid input!, Ensure receiver mobile number and message text is correct');
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function multipleRecipients($receivers,$message)
    {
        try {
            if(!empty($receivers) && !empty($message)) {
                $body = [
                    'to' => $receivers,
                    'text' => $message,
                ];
                $response= $this->messageClass->sendBulk($body);
                return json_decode($response);
            }else{
                throw new Exception('Invalid input!, Ensure receiver mobile number and message text is correct');
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function checkStatus($transaction_id)
    {
        try {
            if(!empty($transaction_id)) {
                $body = [
                    'transactionId' => $transaction_id,
                ];
                $response= $this->messageClass->checkStatus($body);
                return json_decode($response);
            }else{
                throw new Exception('Invalid input!, Ensure transactionId is correct');
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
}
