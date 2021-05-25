<?php

use App\Services\UserWelcomeMail;
use App\Services\Templates\ApprovedTemplate;
use Oaparecido\Courier\Courier;

test('Courier package init', function () {

    /**
     * Esperar um array ou uma string
     * se for um array faça um loop
     * 
     * Deixar a responsabilidade somente em uma classe para email.
     */
    Courier::dispatcher((new UserWelcomeMail()), 'Daniel Aparecido|daniel.aparecido@gmail.com');

    expect([])->toBeArray();
});
