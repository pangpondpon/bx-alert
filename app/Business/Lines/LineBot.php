<?php


namespace App\Business\Lines;


class LineBot
{
    /** @var \LINE\LINEBot */
    private $bot;

    public function __construct()
    {
        $this->createBot();
    }

    private function createBot()
    {
        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(config('bx.alert.line.channel_access_token'));
        $this->bot = new \LINE\LINEBot($httpClient, ['channelSecret' => config('bx.alert.line.channel_secret')]);
    }

    public function getBot()
    {
        return $this->bot;
    }

    public static function getLineBotInstance(): \LINE\LINEBot
    {
        return app('line');
    }
}