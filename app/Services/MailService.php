<?php


namespace App\Services;

use Oaparecido\Courier\Manipulators\MailHandler;
use Oaparecido\Courier\Manipulators\TemplateService;

class MailService extends MailHandler
{
    public string $sender = 'daniel.aparecido@maquinadobem.com';
    public string $fromName = 'Daniel Aparecido';
    public string $template = 'approved';

    /**
     * Construir o template no constructor do arquivo;
     * instanciar e alterar os campos;
     */

    public function getSubject(): string
    {
        return 'O assunto do email!';
    }

    public function toBeSent(): array
    {
        return [
            'approved',
            'reproved'
        ];
    }
}
