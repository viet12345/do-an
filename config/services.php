<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],
    'facebook' => [
        'client_id' => '206820794061814',  //client face của bạn
        'client_secret' => '392cc72e5a0fd865b7b7553924b5bec9',  //client app service face của bạn
        'redirect' => 'http://localhost:8888/banbanh/public/index.php/callback' //callback trả về
    ],
    'google' => [
        'client_id' => '292077246556-r3ri8l0hmojp64ghbg8qeutfo4ekhhp6.apps.googleusercontent.com',
        'client_secret' => 'wktExujG-lxeT2Yspy99mN8J',
       
        'redirect' => 'http://localhost:8888/banbanh/public/index.php/callback-google'
    ],


];
