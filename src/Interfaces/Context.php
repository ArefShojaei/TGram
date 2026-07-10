<?php

namespace TGram\Interfaces;

use TGram\Interfaces\Chat\{
    HasCallbackQuery,
    HasChatManager,
    HasMediaSender,
    HasMessageManager,
};

interface Context extends
    HasMediaSender,
    HasChatManager,
    HasMessageManager,
    HasCallbackQuery
{
    public function setParams(array $params): void;

    public function params(?string $key = null): string|array|null;
}
