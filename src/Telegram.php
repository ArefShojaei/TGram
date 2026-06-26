<?php

namespace TGram;

use TGram\Enums\ProcessMode;
use TGram\Utils\{Console, Settings};
use TGram\Interfaces\Telegram as ITelegram;
use TGram\Validators\BotTokenValidator;
use TGram\Exceptions\EmptyArrayException;
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
        $validator = new BotTokenValidator($token);

        $validator->validate();

        parent::__construct($token);
    }

    public function configure(array $settings): void
    {
        if (empty($settings)) throw new EmptyArrayException("Settings cannot be empty!");

        Settings::set($settings);
    }

    public function run(): void
    {
        echo Console::info("Bot is running...") . PHP_EOL;

        $driver = Settings::get("transport.driver", ProcessMode::POLLING);

        match ($driver) {
            ProcessMode::POLLING => $this->runPolling(),
            ProcessMode::WEBHOOK => $this->runWebhook(),
        };
    }
}
