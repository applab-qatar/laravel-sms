<?php

use Applab\LaravelSms\ApplabSms;

Route::group(['middleware' => ['web', 'auth'],'prefix'=>'test'], function () {
    Route::get('sendOtp/{mobile}', function ($mobile) {
        $applabSMS=new ApplabSms();
        $response= $applabSMS->otpSend($mobile,config('applab-sms.message-id'));
        print_r($response);
    })->where(['mobile' => '(974)[0-9]+']);
    Route::get('resendOtp/{pin_id}', function ($pinid) {
        $applabSMS=new ApplabSms();
        $response= $applabSMS->otpReSend($pinid);
        print_r($response);
    });

    Route::get('verifyOtp/{pin_id}/{otp}', function ($pinid,$otp) {
        $applabSMS=new ApplabSms();
        $response= $applabSMS->otpVerify($pinid,$otp);
        print_r($response);
    });

    Route::get('single/{mobile}/{lng}', function ($mobile,$lng) {
        $applabSMS=new ApplabSms();
        if($lng=='en'){
            $msg="Lorem ipsum  sit amet, consectetur adipiscing elit. Quisque nisl eros, pulvinar facilisis justo mollis, auctor consequat urna. Morbi a bibendum metus.";
        }elseif ($lng=='ar'){
            $msg=" هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم";
        }else
            $msg="Morbi a bibendum metus. ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للن";
        $response= $applabSMS->singleMessage($mobile,$msg);
        print_r($response);
    });
    Route::get('bulk/{mobiles}/{lng}', function ($mobile,$lng) {
        $applabSMS=new ApplabSms();
        if($lng=='en'){
            $msg="Lorem ipsum  sit amet, consectetur adipiscing elit. Quisque nisl eros, pulvinar facilisis justo mollis, auctor consequat urna. Morbi a bibendum metus.";
        }elseif ($lng=='ar'){
            $msg=" هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم";
        }else
            $msg="Morbi a bibendum metus. ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للن";
        $response= $applabSMS->singleMessage($mobile,$msg);
        print_r($response);
    });
    Route::get('status/{trans_id}', function ($transId) {
        $applabSMS=new ApplabSms();
        $response= $applabSMS->checkStatus($transId);
        print_r($response);
    });
});
