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

        foreach ($this->hears as $pattern => $handler) {
            if (!$this->isRegexPattern($pattern)) {
                $pattern = "/" . $pattern . "/";
            }

            preg_match($pattern, $this->input, $matches);

            if (count($matches)) break;
        }

        if (empty($matches)) {
            $handler = $this->getFallbackHandler($fallbackMessage);
        }

        $this->execute($handler, $context);
    }

    private function isRegexPattern(string $pattern): bool
    {
        return str_starts_with($pattern, "/") && str_ends_with($pattern, "/");
    }
}
