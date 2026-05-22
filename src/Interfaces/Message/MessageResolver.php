<?php

namespace TGram\Interfaces\Message;

interface MessageResolver
{
    public function dispatch(): void;
}
