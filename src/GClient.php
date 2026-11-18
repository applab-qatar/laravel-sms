<?php


namespace Applab\LaravelSms;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
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
    }

    // Authenticated POST; on 401 (expired token) logs in again and retries once.
    protected function post($uri, $body, $errorMessage, $retry = true)
    {
        try {
            $response = $this->client->request('POST', $uri, [
                'headers' => [
                    'Authorization' => "Bearer " . Cache::get('applab-sms-btoken'),
                    'Accept' => 'application/json',
                    'Accept-Language' => app()->getLocale(),
                    'apiKey' => config('applab-sms.api-key'),
                ], 'json' => $body
            ]);
        } catch (ClientException $e) {
            if ($retry && $e->getResponse() && $e->getResponse()->getStatusCode() == 401) {
                (new Authentication())->login();
                return $this->post($uri, $body, $errorMessage, false);
            }
            throw $e;
        }
        $contents = (string) $response->getBody();
        if ($contents) {
            return $contents;
        }
        throw new \ErrorException($errorMessage);
    }
}
