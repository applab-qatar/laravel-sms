<?php


namespace Applab\LaravelSms;

class OTPSms extends GClient
{
    public function sendOtp($body)
    {
        return $this->post('2fa/send', $body, "OTP Sending failed");
    }

    public function verify($body)
    {
        return $this->post('2fa/verify', $body, "OTP Verification failed");
    }

    public function resend($body)
    {
        return $this->post('2fa/resend', $body, "OTP ReSending failed");
    }
}
