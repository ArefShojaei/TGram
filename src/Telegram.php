<?php

namespace TGram;

use TGram\Interfaces\Telegram as ITelegram;
use TGram\Enums\ProcessMode;
use TGram\Utils\Console;
use TGram\Abilities\{
    CanProvideCommandManager,
    CanProvideListener,
    CanProvideProcessManager,
};


final class Telegram extends Bot implements ITelegram
{
    use CanProvideListener, CanProvideProcessManager, CanProvideCommandManager;


    public function __construct(string $token)
    {
        parent::__construct($token);
    }

    public function run(ProcessMode $mode = ProcessMode::POLLING): void
    {
        echo Console::info("Bot is running...") . PHP_EOL;

        $mode !== ProcessMode::WEBHOOK
            ? $this->runPolling()
            : $this->runWebhook();
    }
}
