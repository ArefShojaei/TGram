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

    public function __construct(
        public readonly Update $update,
        private Bot $bot,
    ) {}
}
