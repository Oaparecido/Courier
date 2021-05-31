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
        self::validateReceiver($receiver);

        $mailService->start();

        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->addAddress($receiver['to_email'], $receiver['to_name']);
        $mail->Subject = $mailService->subject;
        $mail->Body = $mailService->html;
        $mail->isHTML(true);
        Configurations::setMailer($mail);

        if (!$mail->send())
            return ['status' => false, 'messsage' => $mail->ErrorInfo];

        return ['status' => true, 'message' => 'e-mail enviado com sucesso'];
    }

    private static function validateReceiver($receiver)
    {
        $rules = [
            'to_name' => 'required|string|min:3',
            'to_email' => 'required|email',
        ];

        $validator = Validator::make($receiver, $rules);

        if ($validator->fails())
            return ['status' => false, 'errors' => $validator->errors()];

        return $receiver;
    }
}
