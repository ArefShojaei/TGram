<?php

namespace TGram\Messages;

use TGram\Context;
use TGram\Enums\FallbackMessage;
use TGram\Interfaces\MessageStrategy;
use TGram\Utils\Settings;

final class TextMessageStrategy implements MessageStrategy
{
    public function __construct(private string $input, private array $hears) {}

    public function handle(Context $context): void
    {
        $messages = Settings::get("fallback_messages");

        $fallbackMessage = strlen($messages["command"])
            ? $messages["command"]
            : FallbackMessage::MEDIA->value;

        $callback =
            $this->hears[$this->input] ??
            fn(Context $ctx) => $ctx->sendMessage($fallbackMessage);

        call_user_func($callback, $context);
    }
}
