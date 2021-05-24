<?php

use App\Services\MailService;
use App\Services\Templates\ApprovedTemplate;
use Oaparecido\Courier\Courier;

test('Courier package init', function () {
    /**
     * Passar na chmaada da função o nome do destinatário e email.
     * passar como array ou inicializar com geters and seters;
     */
    Courier::dispatcher((new MailService()), (new ApprovedTemplate()));

    expect([])->toBeArray();
});
