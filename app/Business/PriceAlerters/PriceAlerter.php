<?php


namespace App\Business\PriceAlerters;


use App\Business\Lines\LineMessage;
use App\Business\Pairs\PairFinder;
use App\Exceptions\PairNotFoundException;
use App\Pair;

class PriceAlerter
{
    /** @var string */
    private $primary;

    /** @var string */
    private $secondary;

    /** @var float */
    private $threshold;

    /** @var Pair */
    private $pair;

    /**
     * PairAlerter constructor.
     *
     * @param string $primary
     * @param string $secondary
     * @param float $threshold
     */
    public function __construct($primary, $secondary, $threshold)
    {
        $this->primary = $primary;
        $this->secondary = $secondary;
        $this->threshold = $threshold;
    }

    public function alertIfPriceAboveThreshold()
    {
        $this->pair = $this->findPair();

        if($this->priceMoreThanThreshold()) {
            $this->sendAlertToLine();
        }
    }

    private function findPair(): Pair
    {
        $finder = new PairFinder;

        return $finder->find($this->primary, $this->secondary);
    }

    private function priceMoreThanThreshold()
    {
        return $this->pair->lastPrice >= $this->threshold;
    }

    private function sendAlertToLine()
    {
        $this->sendTextAlert();
    }

    private function sendTextAlert()
    {
        (new LineMessage)->sendTexts($this->composeTextMessageForAlert());
    }

    private function composeTextMessageForAlert()
    {
        return "Pair {$this->primary} {$this->secondary} now has a price above {$this->formattedThreshold()} baht.";
    }

    private function formattedThreshold()
    {
        return number_format($this->threshold);
    }

}