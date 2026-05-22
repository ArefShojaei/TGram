<?php

namespace TGram\Messages;

use TGram\Context;
use TGram\Enums\FallbackMessage;
use TGram\Interfaces\Message\MessageStrategy;
use TGram\Utils\Settings;

final class TextMessageStrategy implements MessageStrategy
{
    private const ARRAY_CALLABLE_SIZE = 2;

    public function __construct(private string $input, private array $hears) {}

    public function handle(Context $context): void
    {
        $messages = Settings::get("fallback_messages");

        $fallbackMessage = (isset($messages["text"]) && strlen($messages["text"]))
            ? $messages["text"]
            : FallbackMessage::TEXT->value;

        $handler =
            $this->hears[$this->input] ??
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
