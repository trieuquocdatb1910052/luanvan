<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
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


    'facebook' => [
        'client_id' => '319519486445569',
        'client_secret' => '4136b14b20f48b8e0244997de28e65ea',
        'redirect' => 'http://127.0.0.1:8000/facebook/callback/',
        ],
    
    //Google
    'google' => [
            'client_id' => '790970859457-goneelq2btlj08k0h98ihc8f3nqu5lrp.apps.googleusercontent.com',
            'client_secret' => 'YMQRZo_UH_wIdCudp-nEG6xm',
            'redirect' => 'http://127.0.0.1:8000/google/callback/',
            ],
];
