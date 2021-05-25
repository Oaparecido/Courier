<?php


namespace App\Services;

use Oaparecido\Courier\Services\MailService;

class UserWelcomeMail extends MailService
{
    public string $subject = 'Voce foi aprovado, parabéns!';

    public string $template = 'approved';

    public array $translatable = [
        'GREETING' => 'Helloooooo',
        'CONTENT_MESSAGE' => 'O conteudo da mensagem fica aqui'
    ];
}
