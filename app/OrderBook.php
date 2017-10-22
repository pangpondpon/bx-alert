<?php


namespace App;


class OrderBook
{
    /** @var Volume */
    public $bids;

    /** @var Volume */
    public $asks;

    public function __construct()
    {
        $this->bids = new Volume;
        $this->asks = new Volume;
    }
}