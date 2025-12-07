<?php

namespace TGram;

use TGram\DTO\Update;
use TGram\Interfaces\Context as IContext;


final class Context implements IContext
{
    public function __construct(
        private readonly Update $update,
        private Bot $bot,
    ) {}

    public function reply(string $text): object
    {
        return $this->bot->sendMessage($this->update->chat->id, $text, [
            "reply_to_message_id" => $this->update->message->message_id,
        ]);
    }

    public function send(string $text): object
    {
        return $this->bot->sendMessage($this->update->chat->id, $text);
    }
}
