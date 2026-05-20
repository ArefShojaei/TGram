<?php

namespace TGram\Interfaces;

use TGram\Enums\ProcessMode;

interface Telegram
{
    public function configure(array $settings): void;

    public function run(ProcessMode $mode = ProcessMode::POLLING): void;
}
