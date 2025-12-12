<?php

namespace TGram;

use TGram\DTO\Update;
use TGram\Providers\{HasMediaSender, HasMessageManager};


final class Context
{
    use HasMessageManager, HasMediaSender;

    public function __construct(
        private readonly Update $update,
        private Bot $bot,
    ) {}
}
