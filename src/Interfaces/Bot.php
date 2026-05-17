<?php

namespace TGram\Interfaces;

use TGram\Enums\HttpMethod;

interface Http
{
    public function request(
        HttpMethod $method,
        string $endpoint,
        array $params = [],
    ): object;
}

interface Bot extends Http {}
