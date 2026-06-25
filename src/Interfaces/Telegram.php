<?php

namespace TGram\Interfaces;

use TGram\Interfaces\Command\{
    CommandListener,
    CommandListenerState,
    CommandManager,
};

interface Telegram extends
    CommandManager,
    CommandListener,
    CommandListenerState,
    Webhook
{
    public function configure(array $settings): void;

    public function run(): void;
}
