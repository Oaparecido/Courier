<?php

return [

    'host' => env('COURIER_MAILER', 'smtp.mailtrap.io'),
    'email_sender' => env('COURIER_EMAIL_SENDER', 'no-reply-to@default.com'),
    'name_sender' => env('COURIER_NAME_SENDER', 'Robot'),
    'exceptions' => env('COURIER_EXCEPTIONS', false),

    'smtp' => [
        'auth' => env('COURIER_SMTP_AUTH', true),
        'port' => env('COURIER_SMTP_PORT', '2525'),
        'username' => env('COURIER_SMTP_USERNAME',  '8b9256a7d74c85'),
        'password' => env('COURIER_SMTP_PASSWORD', '986bf3e32695cd'),
    ]
];
