<?php

use App\Services\UserWelcomeMail;
use Oaparecido\Courier\Courier;

test('Courier package init', function () {

    $success = Courier::dispatcher((new UserWelcomeMail()), 'Daniel Aparecido|daniel.aparecido@gmail.com');

    expect($success)->toBe([
        'status' => true,
        'message' => 'e-mail enviado com sucesso'
    ]);
});
