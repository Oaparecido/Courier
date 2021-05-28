<?php


namespace Oaparecido\Courier;

use Exception;
use Illuminate\Support\Facades\Validator;
use Oaparecido\Courier\Services\Configurations;
use Oaparecido\Courier\Services\MailService;
use PHPMailer\PHPMailer\PHPMailer;

class Courier
{
    public static function dispatcher(MailService $mailService, array $receiver): array
    {
        Configurations::validateReceiver($receiver);

        $mailService->start();

        $mail = new PHPMailer();

        Configurations::chooseMailer($mail);

        $mail->CharSet = 'UTF-8';
        $mail->addAddress($receiver['to_email'], $receiver['to_name']);
        $mail->Subject = $mailService->subject;
        $mail->Body = $mailService->html;
        $mail->isHTML(true);

        if (!$mail->send())
            return ['status' => false, 'messsage' => $mail->ErrorInfo];

        return ['status' => true, 'message' => 'e-mail enviado com sucesso'];
    }
}
