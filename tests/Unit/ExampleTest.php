<?php

use App\Services\UserWelcomeMail;
use Oaparecido\Courier\Courier;

test('Courier package init', function () {

    $name_world = 'Mundo dos sonhos';
    $name = 'Daniel Aparecido';

    $service_mail = new UserWelcomeMail([
        'data' => [
            'name_world' => $name_world
        ],
        'greeting' => [
            'name' => $name
        ]
    ]);

    $success = Courier::dispatcher($service_mail, [
        'to_name' => 'Daniel Aparecido',
        'to_email' => 'daniel.aparecido@gmail.com'
    ]);

    expect($success)->toBe([
        'status' => true,
        'message' => 'e-mail enviado com sucesso'
    ]);
});
