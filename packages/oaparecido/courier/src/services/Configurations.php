<?php

namespace Oaparecido\Courier\Services;

use Illuminate\Support\Facades\Validator;
use PHPMailer\PHPMailer\PHPMailer;

class Configurations
{
    private static array $rules = [
        'locale' => 'required|string',
        'exceptions' => 'required|boolean',
        'email_sender' => 'required|email',
        'name_sender' => 'required|string'
    ];

    private static function validateConfigs()
    {
        $toBeValidate = [
            'locale' => config('courier.locale'),
            'exceptions' => config('courier.exceptions'),
            'email_sender' => config('courier.email_sender'),
            'name_sender' => config('courier.name_sender')
        ];

        switch (config('courier.default')) {
            case 'smtp':
                self::$rules = array_merge(self::$rules, [
                    'host' => 'required|string',
                    'auth' => 'required|boolean',
                    'port' => 'required|numeric',
                    'username' => 'required|string',
                    'password' => 'required|string',
                ]);

                $toBeValidate = array_merge($toBeValidate, config('courier.mailers.smtp'));
                break;
        }

        $validator = Validator::make($toBeValidate, self::$rules);

        if ($validator->fails())
            return ['status' => false, 'errors' => $validator->errors()];

        return $toBeValidate;
    }

    public static function validateReceiver($receiver)
    {
        $rules = [
            'to_name' => 'required|string|min:3',
            'to_email' => 'required|email',
        ];

        $validator = Validator::make($receiver, self::$rules);

        if ($validator->fails())
            return ['status' => false, 'errors' => $validator->errors()];

        return $receiver;
    }

    public static function chooseMailer(PHPMailer $mail)
    {
        $configurations = Configurations::validateConfigs();
        if (config('courier.default') === 'smtp') {
            $mail->isSMTP();
            $mail->Host = $configurations['host'];
            $mail->SMTPAuth = $configurations['auth'];
            $mail->Port = $configurations['port'];
            $mail->Username = $configurations['username'];
            $mail->Password = $configurations['password'];
            $mail->setFrom($configurations['email_sender'], $configurations['name_sender']);
        }
    }
}
