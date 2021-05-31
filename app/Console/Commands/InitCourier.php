<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InitCourier extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'courier:init {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize all files and content to use courier';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info(Carbon::now() . ' >>> Generate file to mail service');
        Artisan::call('make:courier-mail-service ' . $this->argument('filename'));
        $this->info(Carbon::now() . ' >>> Generate file to mail template');
        Artisan::call('make:courier-template ' . $this->argument('filename'));
    }
}
