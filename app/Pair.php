<?php


namespace App;


class Pair
{
    /** @var int */
    public $pairingId;

    /** @var string */
    public $primaryCurrency;

    /** @var string */
    public $secondaryCurrency;

    /** @var float */
    public $change;

    /** @var float */
    public $lastPrice;

    /** @var float */
    public $volume24Hours;

    /** @var OrderBook */
    public $orderBook;

    public function __construct()
    {
        $this->orderBook = new OrderBook;
    }
}