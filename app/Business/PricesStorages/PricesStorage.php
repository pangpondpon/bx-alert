<?php


namespace App\Business\PricesStorages;


use Illuminate\Support\Collection;

class PricesStorage
{
    public static function prices(): Collection
    {
        return app('prices');
    }
}