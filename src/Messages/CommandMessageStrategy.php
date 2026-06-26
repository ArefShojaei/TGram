<?php

namespace TGram\Messages;

use TGram\Context;
use TGram\Utils\Settings;
use TGram\Enums\FallbackMessage;
use TGram\Executors\MessageExecutor;
use TGram\Interfaces\Message\MessageStrategy;

final class CommandMessageStrategy extends MessageExecutor implements
    MessageStrategy
{
    public function __construct(
        private string $input,
        private array $commands,
    ) {}

    public function handle(Context $context): void
    {
        $command = ltrim($this->input, "/");

        $messages = Settings::get("fallback_messages");

        $fallbackMessage =
            isset($messages["command"]) && strlen($messages["command"])
                ? $messages["command"]
                : FallbackMessage::COMMAND->value;

        $handler =
            $this->commands[$command] ??
            fn(Context $ctx) => $ctx->sendMessage($fallbackMessage);

        $this->execute($handler, $context);
    }
}
