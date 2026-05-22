<?php

namespace TGram\Interfaces;

interface MessageResolver
{
    public function dispatch(): void;
}
