<?php

namespace TGram;

use TGram\DTO\Update;
use TGram\Interfaces\Context as IContext;
use TGram\Providers\{
    HasCallbackQuery,
    HasChatManager,
    HasMediaSender,
    HasMessageManager,
};

final class Context implements IContext
{
    use HasMessageManager, HasMediaSender, HasChatManager, HasCallbackQuery;

    private array $commandParams = [];

    public function __construct(
        public readonly Update $update,
        private Bot $bot,
    ) {}

    public function setParams(array $params): void
    {
        $this->commandParams = $params;
    }

    public function params(?string $key = null): string|array|null
    {
        if (!isset($key)) return $this->commandParams;

        return $this->commandParams[$key] ?? null;
    }
}
