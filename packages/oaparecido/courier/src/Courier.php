<?php


namespace Oaparecido\Courier;

use Oaparecido\Courier\Manipulators\MailHandler;
use Oaparecido\Courier\Services\TemplateService;
use PHPMailer\PHPMailer\PHPMailer;

abstract class Courier
{
    /**
     * 1 começar a dar corpo:
     * [] melhorar nomes;
     * [] separar responsabilidades das classes;
     *      classes:
     *      - configurations
     *      - templates
     * [] implamentar configurações para envio com SES
     */

    final public static function dispatcher(MailHandler $handler, TemplateService $manipulator): array
    {
        // isso é LARAVEL
        // isso pode ser usado para:
        //  -> para todo tipo de configuração que possa variar dependendo do projeto.
        //      ex: Configurarções do amazonSES.
        // dd(config('hermesMail.name'));

        $manipulator->init();

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '8b9256a7d74c85';
        $mail->Password = '986bf3e32695cd';
        $mail->setFrom($handler->sender, $handler->fromName);
        $mail->addReplyTo($handler->sender, $handler->fromName);
        $mail->addAddress('daniel.aparecido@maquinadobem.com', 'Daniel Aparecido');
        $mail->Subject = $handler->getSubject();
        $mail->CharSet = 'UTF-8';
        $mail->msgHTML($manipulator->getHtml());

        if (!$mail->send())
            return ['status' => false, 'error' => $mail->ErrorInfo];

        return ['status' => true, 'message' => 'e-mail enviado com sucesso'];
    }
}
