<?php


namespace App\Business\PricesFetchers;


use Illuminate\Support\Collection;

class PriceFetcher
{
    /** @var Collection */
    private $prices;

    public function __construct()
    {
        $this->getPricesFromBxInTh();
    }

    private function getPricesFromBxInTh()
    {
        $fileContent = $this->getFileContent();

        $prices = $this->contentToCollection($fileContent);

        $this->prices = (new PriceFetcherTransformer)->transformMultiple($prices);
    }

    private function getFileContent()
    {
        return file_get_contents(config('bx.api.base_url'));
    }

    private function contentToCollection($fileContent)
    {
        return collect((json_decode($fileContent, true)))->values();
    }

    public function getPrices()
    {
        return $this->prices;
    }

}