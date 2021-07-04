<?php


namespace Applab\LaravelSms;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;

class OTPSms extends GClient
{
    //authenticate the app api user for all requests
    public function sendOtp($body)
    {
        try {
            $response = $this->client->request('POST', '2fa/send', [
                'headers' => [
                    'Authorization' => "Bearer " . Cache::get('applab-sms-btoken'),
                    'Accept' => 'application/json',
                    'Accept-Language' => app()->getLocale(),
                    'secretKey' => config('applab-sms.secret-key'),
                ], 'json' => $body
            ]);
            if ($response->getBody()->getContents()) {
                return $response->getBody();
            }
            throw new \ErrorException("OTP Sending failed");
        } catch (GuzzleException $e) {
            throw $e;
        }
    }

    public function verify($body)
    {
        try {
            $response = $this->client->request('POST', '2fa/verify', [
                'headers' => [
                    'Authorization' => "Bearer " . Cache::get('applab-sms-btoken'),
                    'Accept' => 'application/json',
                    'Accept-Language' => app()->getLocale(),
                    'secretKey' => config('applab-sms.secret-key'),
                ], 'json' => $body
            ]);
            if ($response->getBody()->getContents()) {
                return $response->getBody();
            }
            throw new \ErrorException("OTP Verification failed");
        } catch (GuzzleException $e) {
            throw $e;
        }
    }


    public function resend($body)
    {
        try {
            $response = $this->client->request('POST', '2fa/resend', [
                'headers' => [
                    'Authorization' => "Bearer " . Cache::get('applab-sms-btoken'),
                    'Accept' => 'application/json',
                    'Accept-Language' => app()->getLocale(),
                    'secretKey' => config('applab-sms.secret-key'),
                ], 'json' => $body
            ]);
            if ($response->getBody()->getContents()) {
                return $response->getBody();
            }
            throw new \ErrorException("OTP ReSending failed");
        } catch (GuzzleException $e) {
            throw $e;
        }
    }
}
