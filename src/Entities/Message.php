<?php

namespace TGram\Entities;

use TGram\Bot;
use TGram\DTO\Update;
use TGram\Interfaces\Context;


final class Message implements Context
{
    public function __construct(
        private readonly Update $update,
        private Bot $bot,
        private readonly string $text,
        private readonly array $options = [],
    ) {}

    public function reply(): object
    {
        return $this->bot->sendMessage($this->update->chat->id, $this->text, [
            "reply_to_message_id" => $this->update->message->message_id,
            ...$this->options,
        ]);
    }

    public function send(): object
    {
        return $this->bot->sendMessage(
            $this->update->chat->id,
            $this->text,
            $this->options,
        );
    }
}
