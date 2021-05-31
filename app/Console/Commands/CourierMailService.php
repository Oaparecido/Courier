<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class CourierMailService extends GeneratorCommand
{

    /**
     * hidde command in the list
     * @var boolean
     */
    protected $hidden = true;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:courier-mail-service {name}';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'class';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new file to service mail';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return './stubs/courier/service.mail.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Services\Courier';
    }
}
