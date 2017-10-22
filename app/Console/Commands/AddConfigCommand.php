<?php

namespace App\Console\Commands;

use App\AutoAlertConfig;
use Illuminate\Console\Command;

class AddConfigCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:config {primary} {secondary} {threshold}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add auto alert config command.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        AutoAlertConfig::add(
            $this->argument('primary'),
            $this->argument('secondary'),
            (float) $this->argument('threshold')
        );
    }
}
