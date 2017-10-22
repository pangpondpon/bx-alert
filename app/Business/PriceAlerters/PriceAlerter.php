<?php


namespace App\Business\PriceAlerters;


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
        $pair = $this->findPair();


        if($pair->lastPrice >= $this->threshold) {
            echo "Alert needed!\n";
        }
    }

    private function findPair(): Pair
    {
        $finder = new PairFinder;

        return $finder->find($this->primary, $this->secondary);
    }

}