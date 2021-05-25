<?php


namespace Oaparecido\Courier;

use Exception;
use Oaparecido\Courier\Services\MailService;
use PHPMailer\PHPMailer\PHPMailer;

class Courier
{
    public static function dispatcher(MailService $mailService, array|string $receiver): array
    {
        $receiver = self::transform($receiver);

        $mailService->replace();

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->Host = config('courier.host');
        $mail->SMTPAuth = config('courier.smtp.auth');
        $mail->Port = config('courier.smtp.port');
        $mail->Username = config('courier.smtp.username');
        $mail->Password = config('courier.smtp.password');
        $mail->setFrom(config('courier.email_sender'), config('courier.name_sender'));
        $mail->addAddress($receiver['to_email'], $receiver['to_name']);
        $mail->Subject = $mailService->subject;
        $mail->Body = $mailService->html;
        $mail->isHTML(true);

        if (!config('courier.exceptions') && !$mail->send())
            throw new Exception($mail->ErrorInfo, 500);

        return ['status' => true, 'message' => 'e-mail enviado com sucesso'];
    }

    private static function transform(array|string $receiver): array
    {
        if (!is_array($receiver)) {
            $receiver = explode('|', $receiver);
            // TODO: Verify if $receiver[1] is e-mail 
            $receiver = [
                'to_name' => $receiver[0],
                'to_email' => $receiver[1]
            ];
        }

        return $receiver;
    }
}
