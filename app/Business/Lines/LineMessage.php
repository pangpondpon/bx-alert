<?php


namespace App\Business\Lines;

use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\Response;

class LineMessage
{
    /** @var \LINE\LINEBot */
    private $bot;

    /** @var array */
    private $userIds;

    /** @var MultiMessageBuilder */
    private $multiMessageBuilder;

    /** @var Response */
    private $response;

    public function __construct()
    {
        $this->bot = LineBot::getLineBotInstance();
        $this->userIds = $this->getUserIds();

        $this->multiMessageBuilder = new MultiMessageBuilder;
    }

    protected function getUserIds(): array
    {
        return config('bx.alert.line.user_ids');
    }

    public function sendTexts(...$messages)
    {
        if(!count($this->userIds)) return;

        $this->addMessagesToMultiMessageBuilder($messages);

        $this->response = $this->multicastMultiMessageToLine();
    }

    private function addMessagesToMultiMessageBuilder($messages)
    {
        foreach ($messages as $message) {
            $this->multiMessageBuilder->add(new TextMessageBuilder($message));
        }
    }

    private function multicastMultiMessageToLine()
    {
        return $this->bot->multicast(
            $this->userIds,
            $this->multiMessageBuilder
        );
    }

    public function getResponse()
    {
        return $this->response;
    }
}