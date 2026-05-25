<?php

namespace TGram\Exceptions;

use InvalidArgumentException;

final class InvalidTokenException extends InvalidArgumentException
{
    public function __construct(string $message = "Invalid bot token!")
    {
        parent::__construct($message);
    }
}
