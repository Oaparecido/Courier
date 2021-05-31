<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CourierTemplate extends Command
{
    protected $hidden = true;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:courier-template {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function handle()
    {
        $content = '<!-- ✨ WRITE YOUR HTML CODE HERE! ✨ -->' . PHP_EOL;
        $content .= '<!-- ✏️ For the translate fields use {{field_translatable_here}} -->';

        Storage::disk('mails')->put($this->argument('name') . '.html', $content);
    }
}
