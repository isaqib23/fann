<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'mode'   => env('STRIPE_MODE'),
        'currency'   => env('STRIPE_CURRENCY'),
        'api_version'   => env('STRIPE_VERSION'),
        'production'   => [
            'publish' => env('STRIPE_PROD_PUBLISH'),
            'secret' => env('STRIPE_PROD_SECRET'),
            'client_id'   => env('STRIPE_PROD_CLIENT'),
        ],
        'sandbox'   => [
            'publish' => env('STRIPE_TEST_PUBLISH'),
            'secret' => env('STRIPE_TEST_SECRET'),
            'client_id'   => env('STRIPE_TEST_CLIENT'),
        ],
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

    'generic' => [
        'zip_destination_path' => env('ZIP_DESTINATION_PATH'),
        'zip_extract_path' => env('ZIP_EXTRACT_PATH'),
    ],

    'instagram' => [
        'client_id' => env('INSTAGRAM_KEY'),
        'client_secret' => env('INSTAGRAM_SECRET'),
        'redirect' => env('INSTAGRAM_REDIRECT_URI')
    ],
    'youtube' => [
        'key' => env('YOUTUBE_API_KEY'),
    ]
];
