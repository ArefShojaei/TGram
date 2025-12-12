<?php

namespace TGram\Interfaces;

use TGram\Enums\ProcessMode;


interface Telegram
{
    public function run(ProcessMode $mode = ProcessMode::POLLING): void;
}
