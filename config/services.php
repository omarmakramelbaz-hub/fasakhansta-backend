<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have a
    | conventional file to locate this information.
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
    'fcm' => [
        'project_id' => 'fasakhaninjatest',
    ],

    'google' => [
        // Public OAuth client IDs. Environment values can override these,
        // while the defaults keep production and APK verification aligned
        // with the Firebase project used by the customer app.
        'client_id' => env(
            'GOOGLE_CLIENT_ID',
            '224648167390-efdtr7rjcnept7eiml1d642sdn8n9ki7.apps.googleusercontent.com'
        ),
        'android_client_id' => env(
            'GOOGLE_ANDROID_CLIENT_ID',
            '224648167390-d4fc6jflatn61r66guemktla3itbsqum.apps.googleusercontent.com'
        ),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('APP_URL') . '/api/auth/social/google/callback',
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('APP_URL') . '/api/auth/social/facebook/callback',
    ],

];
