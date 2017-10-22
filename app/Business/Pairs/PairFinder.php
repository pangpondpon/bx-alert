<?php


namespace App\Business\Pairs;


use App\Business\PricesStorages\PricesStorage;
use App\Exceptions\PairNotFoundException;
use App\Pair;
use Illuminate\Support\Collection;

class PairFinder
{
    public function find($primary, $secondary)
    {
        $prices = PricesStorage::prices();

        $pair = $this->findFirstPairMatch($prices, $primary, $secondary);

        $this->validatePair($pair, $primary, $secondary);

        return $pair;
    }

    private function findFirstPairMatch(Collection $prices, $primary, $secondary)
    {
        return $prices->first(function(Pair $price) use($primary, $secondary) {
            return $price->primaryCurrency == $primary && $price->secondaryCurrency == $secondary;
        });
    }

    private function validatePair($pair, $primary, $secondary)
    {
        throw_unless(
            $pair,
            PairNotFoundException::class,
            "Pair not found! Primary: {$primary}, Secondary: {$secondary}"
        );
    }
}