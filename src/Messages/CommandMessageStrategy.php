<?php

namespace TGram\Messages;

use Closure;
use TGram\Enums\FallbackMessage;
use TGram\Context;
use TGram\Interfaces\Message\MessageStrategy;
use TGram\Utils\Settings;

final class CommandMessageStrategy implements MessageStrategy
{
    private const ARRAY_CALLABLE_SIZE = 2;

    public function __construct(
        private string $input,
        private array $commands,
    ) {}

    public function handle(Context $context): void
    {
        $command = ltrim($this->input, "/");

        $messages = Settings::get("fallback_messages");

        $fallbackMessage = (isset($messages["command"]) && strlen($messages["command"]))
            ? $messages["command"]
            : FallbackMessage::COMMAND->value;

        $handler =
            $this->commands[$command] ??
            fn(Context $ctx) => $ctx->sendMessage($fallbackMessage);

        # Array callable [object, 'method']
        if (is_array($handler) && count($handler) === self::ARRAY_CALLABLE_SIZE) {
            $namespace = current($handler);
            $method = end($handler);

            $instnace = new $namespace;

            $instnace->{$method}($context);
        }

        # Closure
        if ($handler instanceof Closure) call_user_func($handler, $context);
    }
}
