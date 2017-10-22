<?php


namespace App\Business\PricesFetchers;


use App\Pair;
use Illuminate\Support\Collection;

class PriceFetcherTransformer
{
    public function transformSingle($price)
    {
        $pair = new Pair;

        $pair->pairingId = $price['pairing_id'];
        $pair->primaryCurrency = $price['primary_currency'];
        $pair->secondaryCurrency = $price['secondary_currency'];
        $pair->change = $price['change'];
        $pair->lastPrice = $price['last_price'];
        $pair->volume24Hours = $price['volume_24hours'];

        $pair->orderBook->bids->total = $price['orderbook']['bids']['total'];
        $pair->orderBook->bids->volume = $price['orderbook']['bids']['volume'];
        $pair->orderBook->bids->highBid = $price['orderbook']['bids']['highbid'];

        $pair->orderBook->asks->total = $price['orderbook']['bids']['total'];
        $pair->orderBook->asks->volume = $price['orderbook']['bids']['volume'];
        $pair->orderBook->asks->highBid = $price['orderbook']['bids']['highbid'];

        return $pair;
    }

    public function transformMultiple(Collection $prices)
    {
        return $prices->transform(function($price) {
            return $this->transformSingle($price);
        });
    }
}