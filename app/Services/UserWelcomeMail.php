<?php


namespace App\Services;

use Oaparecido\Courier\Manipulators\MailService;

class UserWelcomeMail extends MailService
{
    public string $template = 'approved';

    /**
     * Construir o template no constructor do arquivo;
     * instanciar e alterar os campos;
     */

    public function toBeSent(): array
    {
        return [
            'approved',
            'reproved'
        ];
    }
}
