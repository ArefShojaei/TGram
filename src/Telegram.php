<?php

namespace TGram;

use TGram\Enums\ProcessMode;
use TGram\Utils\{Console, Settings};
use TGram\Interfaces\Telegram as ITelegram;
use TGram\Exceptions\InvalidTokenException;
use TGram\Abilities\{
    CanProvideCommandManager,
    CanProvideListener,
    CanProvideProcessManager,
    CanProvideWebhookSystem,
};

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

    public function run(): void
    {
        echo Console::info("Bot is running...") . PHP_EOL;

        $driver = Settings::get("transport.driver");

        match ($driver) {
            ProcessMode::POLLING => $this->runPolling(),
            ProcessMode::WEBHOOK => $this->runWebhook(),
        };
    }
}
