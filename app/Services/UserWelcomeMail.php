<?php


namespace App\Services;

use Oaparecido\Courier\Services\MailService;

class UserWelcomeMail extends MailService
{
    public string $subject = 'Voce foi aprovado, parabéns!';

    public string $translation = 'user-wellcome';

    public string $template = 'approved';

    public string $locale = 'pt-br';

    public array $translatable = [
        'greeting',
        'content_message',
        'data' => [
            'name_world' => 'Mundo dos dragões'
        ]
    ];
}
