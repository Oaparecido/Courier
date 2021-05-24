<?php


namespace Oaparecido\Courier\Services;

abstract class TemplateService
{
    /**
     * 1 -> criar pacote default para envio de email.
     *  (Criar um command para fazer a criação de templates.)
     *  ./resources/mails/templates
     * 2 -> passar o nome do arquivo.
     * 3 -> verificar os campos que não são traduzíveis.
     * 4 -> verificar os campos traduzíveis.
     *
     * TODO -> alterar o nome da classe;
     */
    private array $untranslatable = [];
    private array $translatable = [];
    private string $template = '';
    private string $html = '';
    private array $types = [];

    final public function replace()
    {
        $this->html = $this->getTemplate();
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

    private function setType()
    {
        if (in_array($this->template, $this->types)) {
            $this->template = $this->types[array_search($this->template, $this->types)];
        }
    }

    abstract public function init();

    final protected function setTranslatables(array $translatable)
    {
        $this->translatable = $translatable;
    }

    final public function setTemplate(string $template)
    {
        $this->template = $template;
    }

    final public function getHtml(): string
    {
        return $this->html;
    }
}
