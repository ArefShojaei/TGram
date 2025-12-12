<?php

namespace TGram;

use TGram\Interfaces\Telegram as ITelegram;
use TGram\Abilities\{CanProvideListener, CanProvideProcessManager};
use TGram\Enums\ProcessMode;
use TGram\Utils\Console;


final class Telegram extends Bot implements ITelegram
{
    use CanProvideListener, CanProvideProcessManager;


    public function __construct(string $token)
    {
        parent::__construct($token);
    }

    public function run(ProcessMode $mode = ProcessMode::POLLING): void
    {
        echo Console::info("Bot is running...") . PHP_EOL;

        if ($mode !== ProcessMode::WEBHOOK) $this->runPolling();

        $this->runWebhook();
    }
}
