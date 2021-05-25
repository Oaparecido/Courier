<?php

namespace Oaparecido\Courier\Services;

use Oaparecido\Courier\Services\TemplateService;

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
     * fields on the template that can translatable
     * @var array
     */
    public string $subject = 'subject default';

    /**
     * html to be send
     * @var string
     */
    public string $html = '';

    final public function replace()
    {
        $this->getTemplate();
        $this->translating();
    }

    /**
     * @throws \Exception
     */
    private function getTemplate(): void
    {
        $path = resource_path('mails/templates/' . $this->template . '.html');

        if (file_exists($path)) {
            $this->html = file_get_contents($path);
        } else {
            throw new \Exception('Courier:template-not-found', 422);
        }
    }

    private function translating(): void
    {
        foreach ($this->translatable as $key => $value) {
            // $translated = trans();
            $this->html = str_replace('{{' . strtoupper($key) . '}}', $value, $this->html);
        }
    }
}
