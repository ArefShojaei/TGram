<?php

namespace TGram\Validators;

use TGram\Exceptions\InvalidTokenException;
use TGram\Interfaces\Validator;

final class BotTokenValidator implements Validator
{
    public function __construct(private string $token)
    {
        $this->token = trim($token);
    }

    public function validate(): bool
    {
        if (
            !isset($this->token) or
            !strlen($this->token) or
            !str_contains($this->token, ":")
        ) {
            throw new InvalidTokenException;
        }

        return true;
    }
}
