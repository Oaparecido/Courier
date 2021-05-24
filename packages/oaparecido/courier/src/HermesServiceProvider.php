<?php


namespace Oaparecido\Hermes;


use Illuminate\Contracts\Container\BindingResolutionException;

class HermesServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function boot(){}

    /**
     * @throws BindingResolutionException
     */
    public function register()
    {
        $this->app->make('Oaparecido\Hermes\Courier');
    }

}
