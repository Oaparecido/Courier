<?php


namespace Oaparecido\Courier\Services;

use Illuminate\Support\Facades\App;
use Oaparecido\Courier\Manipulators\MailService;

class TemplateService
{
    private array $untranslatable = [];
    private array $translatable = [];
    private array $translateKey = '';
    private string $template = '';
    private string $html = '';
    private array $types = [];
    private string $locale = '';

    public function replace()
    {
        $this->html = $this->getTemplate();
        $this->translating();
    }

    /**
     * @throws \Exception
     */
    private function getTemplate(): bool|string
    {
        $this->setType();
        $path = resource_path('mails/templates/' . $this->template . '.html');

        if (file_exists($path)) {
            return file_get_contents($path);
        } else {
            throw new \Exception('Courier:template-not-found', 422);
        }
    }

    private function translating()
    {
        foreach ($this->translatable as $key => $value) {
            $translated = trans();
            $this->html = str_replace('{{' . strtoupper($key) . '}}', $value, $this->html);
        }

        dd($this->html);
    }

    private function setType()
    {
        if (in_array($this->template, $this->types)) {
            $this->template = $this->types[array_search($this->template, $this->types)];
        }
    }

    protected function setTranslatables(array $translatable)
    {
        $this->translatable = $translatable;
    }

    public function setTemplate(string $template)
    {
        $this->template = $template;
    }

    public function setLocale(string $locale)
    {
        App::setLocale($locale);
    }

    public function getHtml(): string
    {
        return $this->html;
    }
}
