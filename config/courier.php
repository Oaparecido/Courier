<?php

return [

    'default' => env('COURIER_MAILER', 'smtp'),

    'mailers' => [

        'smtp' => [
            'auth' => env('COURIER_SMTP_AUTH', true),
            'port' => env('COURIER_SMTP_PORT', '2525'),
            'username' => env('COURIER_SMTP_USERNAME',  '8b9256a7d74c85'),
            'password' => env('COURIER_SMTP_PASSWORD', '986bf3e32695cd'),
            'host' => env('COURIER_MAILER', 'smtp.mailtrap.io'),
        ],

        'ses' => [
            'profile' => env('COURIER_SES_PROFILE', 'default'),
            'version' => env('COURIER_SES_VERSION', '2010-12-01'),
            'region' => env('AWS_SES_REGION', 'us-east-1')
        ]
    ],

    'locale' => env('COURIER_LOCALE', 'pt-br'),

    'email_sender' => env('COURIER_EMAIL_SENDER', 'no-reply-to@default.com'),

    'name_sender' => env('COURIER_NAME_SENDER', 'Robot'),

    'exceptions' => env('COURIER_EXCEPTIONS', false),
];
