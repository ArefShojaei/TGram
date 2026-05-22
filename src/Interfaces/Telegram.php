<?php

namespace TGram\Interfaces;

use TGram\Enums\ProcessMode;
use TGram\Interfaces\Command\{
    CommandListener,
    CommandListenerState,
    CommandManager,
};

interface Telegram extends CommandManager, CommandListener, CommandListenerState
{
    public function configure(array $settings): void;

    public function run(ProcessMode $mode = ProcessMode::POLLING): void;
}
