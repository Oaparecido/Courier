<?php


namespace Oaparecido\Courier;

use Oaparecido\Courier\Manipulators\MailService;
use PHPMailer\PHPMailer\PHPMailer;

class Courier
{
    public static function dispatcher(MailService $mailService, array|string $configSender): array
    {
        $config_sender = self::transform($configSender);

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->setFrom(config('courier.email_sender'), config('courier.name_sender'));
        $mail->addAddress($config_sender['to_email'], $config_sender['to_name']);
        $mail->Subject = $mailService->subject;
        $mail->Body = $mailService->html;
        $mail->isHTML(true);

        switch (config('courier.mailer')) {
            case 'amazon_ses':
                self::senderSES($mail);
                break;

            default:
                self::senderDefault($mail);
                break;
        }

        if (!$mail->send())
            return ['status' => false, 'error' => $mail->ErrorInfo];

        return ['status' => true, 'message' => 'e-mail enviado com sucesso'];
    }

    private static function senderSES(PHPMailer $mail): void
    {
    }

    private static function senderDefault(PHPMailer $mail): void
    {
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '8b9256a7d74c85';
        $mail->Password = '986bf3e32695cd';
    }

    private static function transform(array|string $configSender): array
    {
        if (!is_array($configSender)) {
            $config_sender = explode('|', $configSender);
            // TODO: Verify if $config_sender[1] is e-mail 
            $config_sender = [
                'to_name' => $config_sender[0],
                'to_email' => $config_sender[1]
            ];
        }

        return $config_sender;
    }
}
