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
    private const COMMAND_WITH_PARAMETER_COUNT = 2;

    public function __construct(
        private string $input,
        private array $commands,
    ) {}

    public function handle(Context $context): void
    {
        $commandInput = ltrim($this->input, "/");

        $fallbackMessage = Settings::get(
            "fallback_messages.command",
            FallbackMessage::COMMAND->value,
        );

        foreach ($this->commands as $command => $handler) {
            $pattern =
                "/^" .
                str_replace(
                    ["{", "}"],
                    ["(?<", ">[\w\/\:\.\@\?\_\-]+)"],
                    $command,
                ) .
                "$/";

            preg_match($pattern, $commandInput, $matches);

            if (count($matches)) break;
        }

        if (empty($matches)) {
            $handler = $this->getFallbackHandler($fallbackMessage);
        }

        if (
            isset($matches) &&
            count($matches) >= self::COMMAND_WITH_PARAMETER_COUNT
        ) {
            $this->addCommandParams($context, $matches);
        }

        $this->execute($handler, $context);
    }

    private function addCommandParams(Context $context, array $matches): void
    {
        $params = array_filter(
            $matches,
            fn($key) => is_string($key),
            ARRAY_FILTER_USE_KEY,
        );

        $context->setParams($params);
    }
}
