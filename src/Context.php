<?php

namespace TGram;

use TGram\DTO\Update;
use TGram\Interfaces\Context as IContext;
use TGram\Providers\{HasChatManager, HasMediaSender, HasMessageManager};

final class Context implements IContext
{
    use HasMessageManager, HasMediaSender, HasChatManager;

    public function __construct(
        private readonly Update $update,
        private Bot $bot,
    ) {}
}
