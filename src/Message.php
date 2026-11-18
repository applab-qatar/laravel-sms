<?php


namespace Applab\LaravelSms;

class Message extends GClient
{
    public function sendSingle($body)
    {
        return $this->post('send-sms/single', $body, "Message Sending failed");
    }

    public function sendBulk($body)
    {
        return $this->post('send-sms/bulk', $body, "Bulk Sending failed");
    }

    public function checkStatus($body)
    {
        return $this->post('send-sms/status', $body, "Status checking failed");
    }
}
