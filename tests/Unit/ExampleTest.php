<?php

use App\Services\Courier\UserValidation;
use App\Services\UserWelcomeMail;
use Oaparecido\Courier\Courier;

test('Courier package init', function () {

    $service_mail = new UserValidation([]);

    $success = Courier::dispatcher($service_mail, [
        'to_name' => 'Daniel Aparecido',
        'to_email' => 'daniel.aparecido@gmail.com'
    ]);

    expect($success)->toBe([
        'status' => true,
        'message' => 'e-mail enviado com sucesso'
    ]);
});
