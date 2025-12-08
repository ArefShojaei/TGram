<?php

namespace TGram\Entities;

use TGram\Bot;
use TGram\DTO\Update;
use TGram\Interfaces\Context;


final class Location implements Context
{
    public function __construct(
        private readonly Update $update,
        private Bot $bot,
        private readonly float $lat,
        private readonly float $lon,
        private readonly array $options = [],
    ) {}

    public function reply(): object
    {
        return $this->bot->sendLocation($this->update->chat->id, $this->lat, $this->lon, [
            "reply_to_message_id" => $this->update->message->message_id,
            ...$this->options,
        ]);
    }

    public function send(): object
    {
        return $this->bot->sendLocation($this->update->chat->id, $this->lat, $this->lon, $this->options);
    }
}
