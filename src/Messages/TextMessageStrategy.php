<?php

namespace TGram\Messages;

use TGram\Context;
use TGram\Utils\Settings;
use TGram\Enums\FallbackMessage;
use TGram\Executors\MessageExecutor;
use TGram\Interfaces\Message\MessageStrategy;

final class TextMessageStrategy extends MessageExecutor implements
    MessageStrategy
{
    public function __construct(private string $input, private array $hears) {}

    public function handle(Context $context): void
    {
        $fallbackMessage = Settings::get(
            "fallback_messages.text",
            FallbackMessage::TEXT->value,
        );

        $handler =
            $this->hears[$this->input] ??
            fn(Context $ctx) => $ctx->sendMessage($fallbackMessage);

        $this->execute($handler, $context);
    }
}
