<?php

namespace TGram\Messages;

use TGram\Context;
use TGram\Enums\FallbackMessage;
use TGram\Interfaces\Message\MessageStrategy;
use TGram\Utils\Settings;

final class MediaMessageStrategy implements MessageStrategy
{
    private const ARRAY_CALLABLE_SIZE = 2;

    public function __construct(private string $event, private array $events) {}

    public function handle(Context $context): void
    {
        $messages = Settings::get("fallback_messages");

        $fallbackMessage = (isset($messages["media"]) && strlen($messages["media"]))
            ? $messages["media"]
            : FallbackMessage::MEDIA->value;

        $handler =
            $this->events[$this->event] ??
            fn(Context $ctx) => $ctx->sendMessage($fallbackMessage);

        # Array callable [object, 'method']
        if (
            is_array($handler) &&
            count($handler) === self::ARRAY_CALLABLE_SIZE
        ) {
            $namespace = current($handler);
            $method = end($handler);

            $instnace = new $namespace();

            $instnace->{$method}($context);
        }

        # Closure
        call_user_func($handler, $context);
    }
}
