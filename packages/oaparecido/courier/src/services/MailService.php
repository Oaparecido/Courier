<?php

namespace Oaparecido\Courier\Services;

use Illuminate\Support\Facades\App;
use Exception;

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

    /**
     * @var array
     */
    public array $payload = [];

    abstract public function __construct(array $payload = []);

    // mudar nome 
    final public function start()
    {
        $this->getTemplate();
        if (!empty($this->payload))
            $this->translating($this->payload);

        $this->translating();
    }

    /**
     * @throws Exception
     */
    private function getTemplate(): void
    {
        // estudar o blade
        $path = resource_path('mails/templates/' . $this->template . '.html');

        if (file_exists($path)) {
            $this->html = file_get_contents($path);
        } else {
            // se não tem HTTP então não use status code de HTTP
            // traduzir exception (é bom?)
            throw new Exception('Courier:template-not-found', 501);
        }
    }

    private function translating(array $translatables = []): void
    {
        if (empty($translatables))
            $translatables = $this->translatable;

        $this->setLocale();

        foreach ($translatables as $key => $value) {
            if (is_array($value)) {
                $attributes = $value;
                $field = $key;
            } else {
                $attributes = [];
                $field = $value;
            }

            if ($field === 'subject')
                $this->subject = trans('mails.' . $this->translation . '.' . $field, $attributes);

            $translated = trans('mails.' . $this->translation . '.' . $field, $attributes);
            $this->html = str_replace('{{' . strtoupper($field) . '}}', $translated, $this->html);
        }
    }

    private function setLocale()
    {
        $locale = (!empty($this->locale)) ? $this->locale : config('courier.locale');
        App::setLocale($locale);
    }
}
