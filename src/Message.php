<?php


namespace Applab\LaravelSms;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;

class Message extends GClient
{
    public function sendSingle($body)
    {
        try {
            $response = $this->client->request('POST', 'send-sms/single', [
                'headers' => [
                    'Authorization' => "Bearer " . Cache::get('applab-sms-btoken'),
                    'Accept' => 'application/json',
                    'Accept-Language' => app()->getLocale(),
                    'apiKey' => config('applab-sms.api-key'),
                ], 'json' => $body
            ]);
            if ($response->getBody()->getContents()) {
                return $response->getBody();
            }
            throw new \Exception("Message Sending failed");
        } catch (GuzzleException $e) {
            throw $e;
        }
    }

    public function sendBulk($body)
    {
        try {
            $response = $this->client->request('POST', 'send-sms/bulk', [
                'headers' => [
                    'Authorization' => "Bearer " . Cache::get('applab-sms-btoken'),
                    'Accept' => 'application/json',
                    'Accept-Language' => app()->getLocale(),
                    'apiKey' => config('applab-sms.api-key'),
                ], 'json' => $body
            ]);
            if ($response->getBody()->getContents()) {
                return $response->getBody();
            }
            throw new \Exception("Bulk Sending failed");
        } catch (GuzzleException $e) {
            throw $e;
        }
    }

    public function checkStatus($body)
    {
        try {
            $response = $this->client->request('POST', 'send-sms/status', [
                'headers' => [
                    'Authorization' => "Bearer " . Cache::get('applab-sms-btoken'),
                    'Accept' => 'application/json',
                    'Accept-Language' => app()->getLocale(),
                    'apiKey' => config('applab-sms.api-key'),
                ], 'json' => $body
            ]);
            if ($response->getBody()->getContents()) {
                return $response->getBody();
            }
            throw new \Exception("Bulk Sending failed");
        } catch (GuzzleException $e) {
            throw $e;
        }
    }
}
