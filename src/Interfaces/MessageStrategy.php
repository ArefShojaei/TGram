<?php

namespace TGram\Interfaces;

use TGram\Context;

interface MessageStrategy
{
    public function handle(Context $context): void;
}
