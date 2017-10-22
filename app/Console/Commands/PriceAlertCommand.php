<?php

namespace App\Console\Commands;

use App\Business\PriceAlerters\PriceAlerter;
use App\Business\PricesFetchers\PriceFetcher;
use Illuminate\Console\Command;

class PriceAlertCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alert:price {primary} {secondary} {threshold}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Alert when price goes to to the setting point.';

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
        $alerter = new PriceAlerter(
            $this->argument('primary'),
            $this->argument('secondary'),
            (float) $this->argument('threshold')
        );

        $alerter->alertIfPriceAboveThreshold();
    }
}
