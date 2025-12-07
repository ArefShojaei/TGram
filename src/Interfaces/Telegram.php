<?php

namespace TGram\Interfaces;

use TGram\Enums\BotProcessMode;


interface Telegram
{
    public function run(BotProcessMode $mode = BotProcessMode::POLLING): void;
}
