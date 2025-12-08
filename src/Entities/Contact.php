<?php

namespace TGram\Entities;

use TGram\Bot;
use TGram\DTO\Update;
use TGram\Interfaces\Context;


final class Contact implements Context
{
    public function __construct(
        private readonly Update $update,
        private Bot $bot,
        private readonly string $phone,
        private readonly string $firstName,
        private readonly array $options = [],
    ) {}

    public function reply(): object
    {
        return $this->bot->sendContact(
            $this->update->chat->id,
            $this->phone,
            $this->firstName,
            [
                "reply_to_message_id" => $this->update->message->message_id,
                ...$this->options,
            ],
        );
    }

    public function send(): object
    {
        return $this->bot->sendContact(
            $this->update->chat->id,
            $this->phone,
            $this->firstName,
            $this->options,
        );
    }
}
