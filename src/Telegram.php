<?php

namespace TGram;

use TGram\Interfaces\Telegram as ITelegram;
use TGram\Enums\ProcessMode;
use TGram\Utils\Console;
use TGram\Utils\Settings;
use TGram\Abilities\{
    CanProvideCommandManager,
    CanProvideListener,
    CanProvideProcessManager,
    CanProvideWebhookSystem,
};
use TGram\Exceptions\InvalidTokenException;

final class Telegram extends Bot implements ITelegram
{
    use CanProvideListener,
        CanProvideProcessManager,
        CanProvideCommandManager,
        CanProvideWebhookSystem;

    public function __construct(string $token)
    {
        if (!isset($token) or !strlen($token)) throw new InvalidTokenException;

        parent::__construct($token);
    }

    public function configure(array $settings): void
    {
        Settings::set($settings);
    }

    public function run(ProcessMode $mode = ProcessMode::POLLING): void
    {
        echo Console::info("Bot is running...") . PHP_EOL;

        $mode !== ProcessMode::WEBHOOK
            ? $this->runPolling()
            : $this->runWebhook();
    }
}
