<?php

use App\Services\Courier\TestDefault;
use Illuminate\Support\Facades\Artisan;
use Oaparecido\Courier\Courier;

test('Courier send e-mail', function () {
    // Artisan::call('courier:init TestDefault');
    $service_mail = new TestDefault([]);

    $success = Courier::dispatcher($service_mail, [
        'to_name' => 'Daniel Aparecido',
        'to_email' => 'daniel.aparecido@gmail.com'
    ]);

    expect($success)->toBe([
        'status' => true,
        'message' => 'e-mail enviado com sucesso'
    ]);
});
