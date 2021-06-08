<?php

namespace App\Services\Courier;

use Oaparecido\Courier\Services\MailService;

class TestDefault extends MailService
{
    /**
     * array index in the translate file
     * @var string 
     */
    public string $translation = 'test-defatult';

    /**
     * name for get template in files templates
     * @var string 
     */
    public string $template = 'TestDefault';

    /**
     * fields that to be translate on template e-mail
     * @var array
     */
    public array $translatable = ['subject', 'greeting', 'content_default'];

    public function __construct(array $payload = [])
    {
        $this->payload = $payload;
    }
}
