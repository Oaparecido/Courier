<?php


namespace App\Services;

use Oaparecido\Courier\Services\MailService;

class UserWelcomeMail extends MailService
{

    public string $translation = 'user-wellcome';

    public string $template = 'approved';

    public array $translatable = [
        'subject',
        'greeting',
        'content_message'
    ];

    public function __construct(array $payload = [])
    {
        $this->payload = $payload;
    }
}
