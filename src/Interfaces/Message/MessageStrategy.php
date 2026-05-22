<?php

namespace TGram\Interfaces\Message;

use TGram\Context;

interface MessageStrategy
{
    public function handle(Context $context): void;
}
