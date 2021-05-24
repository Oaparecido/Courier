<?php


namespace App\Services\Templates;

use Oaparecido\Courier\Services\TemplateService;

class ApprovedTemplate extends TemplateService
{
    public function init()
    {
        $this->setTranslatables([
            'greetings' => 'Helloooo'
        ]);
        $this->setTemplate('approved');
        $this->replace();
    }
}
