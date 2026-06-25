<?php

namespace TGram\Interfaces;

interface Loggable
{
    public static function log(string $message): void;
}
