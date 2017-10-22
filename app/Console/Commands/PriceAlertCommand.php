<?php

namespace App\Console\Commands;

use App\AutoAlertConfig;
use App\Business\PriceAlerters\PriceAlerter;
use App\Business\PricesFetchers\PriceFetcher;
use App\Exceptions\PairNotFoundException;
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

    private $primary;

    private $secondary;

    private $threshold;

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
        $this->primary = $this->argument('primary');
        $this->secondary = $this->argument('secondary');
        $this->threshold = (float) $this->argument('threshold');

        $alerter = new PriceAlerter(
            $this->primary,
            $this->secondary,
            $this->threshold
        );

        try {
            $alerter->alertIfPriceAboveThreshold();
        } catch (PairNotFoundException $e) {
            $this->setConfigAsInvalid();
        }
    }

    private function setConfigAsInvalid()
    {
        AutoAlertConfig::wherePrimary($this->primary)
            ->whereSecondary($this->secondary)
            ->update([
                'valid' => false,
            ]);
    }
}
