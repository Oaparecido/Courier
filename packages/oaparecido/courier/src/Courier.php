<?php


namespace Oaparecido\Courier;

use Exception;
use Illuminate\Support\Facades\Validator;
use Oaparecido\Courier\Services\MailService;
use PHPMailer\PHPMailer\PHPMailer;

class Courier
{
    public static function dispatcher(MailService $mailService, array $receiver): array
    {
        self::validate($receiver);
        $mailService->start();

        //implementar validação para todos os config
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

        if (!$mail->send())
            return ['status' => false, 'messsage' => $mail->ErrorInfo];

        return ['status' => true, 'message' => 'e-mail enviado com sucesso'];
    }

    private static function validate($receiver)
    {
        $validator = Validator::make($receiver, [
            'to_name' => 'required|string|min:3',
            'to_email' => 'required|email'
        ]);

        if ($validator->fails())
            return ['status' => false, 'errors' => $validator->errors()];
    }
}
