<?php

namespace Oaparecido\Courier\Manipulators;

abstract class MailService
{
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
     * Method from types of emails to be sent
     * @return array
     */
    abstract public function toBeSent(): array;
}
