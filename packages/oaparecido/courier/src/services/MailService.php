<?php

namespace Oaparecido\Courier\Services;

use Illuminate\Support\Facades\App;

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
     * fields for the translation string in file translate
     * @var array
     */
    public string $translation = '';

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

    /**
     * locale to translate
     * @var string
     */
    public string $locale = '';

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
        App::setLocale($this->locale);

        foreach ($this->translatable as $key => $value) {
            if (is_array($value)) {
                $attributes = $value;
                $field = $key;
            } else {
                $attributes = [];
                $field = $value;
            }

            $translated = trans('mails.' . $this->translation . '.' . $field, $attributes);
            $this->html = str_replace('{{' . strtoupper($field) . '}}', $translated, $this->html);
        }
    }
}
