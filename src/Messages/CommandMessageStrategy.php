<?php

namespace TGram\Messages;

use TGram\Enums\FallbackMessage;
use TGram\Context;
use TGram\Interfaces\MessageStrategy;
use TGram\Utils\Settings;

final class CommandMessageStrategy implements MessageStrategy
{
    public function __construct(
        private string $input,
        private array $commands,
    ) {}

    public function handle(Context $context): void
    {
        $command = ltrim($this->input, "/");

        $messages = Settings::get("fallback_messages");

        $fallbackMessage = strlen($messages["command"])
            ? $messages["command"]
            : FallbackMessage::COMMAND->value;

        $callback =
            $this->commands[$command] ??
            fn(Context $ctx) => $ctx->sendMessage($fallbackMessage);

        call_user_func($callback, $context);
    }
}
