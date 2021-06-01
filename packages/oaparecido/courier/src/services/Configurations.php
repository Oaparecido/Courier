<?php

namespace Oaparecido\Courier\Services;

use Aws\Ses\SesClient;
use Illuminate\Support\Facades\Validator;
use PHPMailer\PHPMailer\PHPMailer;

class Configurations
{
    private static int $ses_quota = 0;
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
            case 'ses':
                self::$rules = array_merge(self::$rules,  [
                    'profile' => 'required|string',
                    'version' => 'required|string',
                    'region' => 'required|string',
                    'config.secret' => 'required|string',
                    'config.key' => 'required|string'
                ]);

                $toBeValidate = array_merge($toBeValidate, config('courier.mailers.ses'));
                break;
        }

        $validator = Validator::make($toBeValidate, self::$rules);

        if ($validator->fails())
            return ['status' => false, 'errors' => $validator->errors()];

        return $toBeValidate;
    }

    public static function setMailer(PHPMailer $mail)
    {
        $configurations = Configurations::validateConfigs();

        // TODO: verify if $configurations return true or false;

        $mail->setFrom($configurations['email_sender'], $configurations['name_sender']);
        $mail->isSMTP();

        switch (config('courier.default')) {
            case 'smtp':
                $mail->Host = $configurations['host'];
                $mail->SMTPAuth = $configurations['auth'];
                $mail->Port = $configurations['port'];
                $mail->Username = $configurations['username'];
                $mail->Password = $configurations['password'];
                break;
            case 'ses':
                $message = $mail->getSentMIMEMessage();

                $credentials = new SESCredentials();

                $object = self::getClientSES($configurations, $credentials);
                $object->sendRawEmail(['RawMessage' => ['Data' => $message]]);

                $quota = $object->getSendQuota();
                self::$ses_quota = (intval($quota->get('Max24HourSend')) - intval($quota->get('SentLast24Hours')));
                break;
        }
    }

    private static function getClientSES($configurations, $credentials)
    {
        return new SesClient([
            'credentials' => $credentials,
            'version' => $configurations['version'],
            'region' => $configurations['region'],
        ]);
    }
}
