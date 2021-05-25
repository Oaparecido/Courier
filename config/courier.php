<?php

return [

    'mailer' => env('COURIER_MAILER', 'mailtrap'),
    'email_sender' => env('COURIER_EMAIL_SENDER', 'no-reply-to@default.com'),
    'name_sender' => env('COURIER_NAME_SENDER', 'Robot')
];
