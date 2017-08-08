<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'paypal' => [
        'client_id' => 'AZyV0lkIWE8x6f6buTT18AnQ-EXoox-nGC9pcHOZoq7dWEfjvXMlxmA1XzqNeabPtTgwQkbleiE-5ukz',
        'secret' => 'EIBuM_O-97NFSXeXZn03Re9fq6Bzz8V74OFyXIFFsH882DA45zr4AdgwrmxU4z_uW_l8ChZ0C8sXQVG_'
    ],

];
