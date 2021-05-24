<?php

namespace Oaparecido\Courier\Manipulators;

abstract class MailHandler
{
    /**
     * sender e-mail
     * @var string
     */
    public string $sender = 'no-reply-to@default.com';

    /**
     * sander name
     * @var string
     */
    public string $fromName = 'Default Name Here';

    /**
     * template email path
     * @var string
     */
    public string $template = '';

    /**
     * type e-mail
     * @var string
     */
    public string $type = '';

    /**
     * fields on the template that can't translatable
     * @var array
     */
    public array $untranslatable = [];

    /**
     * fields on the template that can translatable
     * @var array
     */
    public array $translatable = [];

    /**
     * Method return array with settings
     * @return string
     */
    abstract public function getSubject(): string;

    /**
     * Method from types of emails to be sent
     * @return array
     */
    abstract public function toBeSent(): array;
}
