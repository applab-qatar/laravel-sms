<p align="center"><a href="https://applab.qa" target="_blank"><img src="https://applab.qa/wp-content/uploads/2020/11/page-logo.svg" width="400"></a></p>

<p align="center"></p>

## Applab SMS Gateway
This SMS Gateway support you to authenticate your user with SMS OTP

Below are a full list of features:
- Authenticate with One time password
- Single SMS
- Bulk SMS

## About Applab

[AppLab](https://applab.qa/contact-us) is a leading company specialized in online platforms development. Online Platforms include Back-end, Databases, Web Applications and Mobile

## Installing Applab SMS

The recommended way to install Applab Sadad is through
[Composer](https://getcomposer.org/).

```bash
composer require applab/laravel-sms
```
Publish configuration and migrations
```bash
php artisan vendor:publish --provider="Applab\LaravelSms\LaravelSmsServiceProvider"
```

The service provider is loaded automatically using [package discovery](https://laravel.com/docs/5.7/packages#package-discovery).
## Usage

### Configuration
The package ships with a configuration file called applab-sms.php which is published to the config directory during installation. Below is an outline of the settings.
Issued when creating your Applab SMS account
```bash
APPLAB_SMS_USERNAME 
APPLAB_SMS_PASSWORD
APPLAB_SMS_API_KEY
APPLAB_SMS_MESSAGE_ID
```
Message ID optional, This using only for OTP Template
### Authenticate by OTP
```bash
    $response= ApplabSMS::otpSend(MobilNo,MessageID,Lang);
    $response= ApplabSMS::otpReSend($pinId);//recieved before
    $response= ApplabSMS::otpVerify($pinId,$otp);
```
### Single Message
```bash
  ApplabSMS::singleMessage($destination,$message);
```
### Single Message
```bash
  ApplabSMS::multipleRecipients($destinations,$message);
```
## Security Vulnerabilities

If you discover a security vulnerability within this package, please send an e-mail to Manu Applab via [manu@applab.qa](mailto:manu@applab.qa). All security vulnerabilities will be promptly addressed.

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
