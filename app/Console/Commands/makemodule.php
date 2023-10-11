<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class makemodule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create new module';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("module model created successfully");
    }
}
