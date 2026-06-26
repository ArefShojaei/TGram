<?php

namespace TGram\Messages;

use TGram\Context;
use TGram\Utils\Settings;
use TGram\Enums\FallbackMessage;
use TGram\Executors\MessageExecutor;
use TGram\Interfaces\Message\MessageStrategy;

final class MediaMessageStrategy extends MessageExecutor implements
    MessageStrategy
{
    public function __construct(private string $event, private array $events) {}

    public function handle(Context $context): void
    {
        $messages = Settings::get("fallback_messages");

        $fallbackMessage =
            isset($messages["media"]) && strlen($messages["media"])
                ? $messages["media"]
                : FallbackMessage::MEDIA->value;

        $handler =
            $this->events[$this->event] ??
            fn(Context $ctx) => $ctx->sendMessage($fallbackMessage);

        $this->execute($handler, $context);
    }
}
