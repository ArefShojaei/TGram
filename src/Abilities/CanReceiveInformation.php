<?php

namespace TGram\Abilities;

use TGram\Enums\HttpMethod;


trait CanReceiveInformation
{
    protected function getMe(): object
    {
        return $this->request(
            method: HttpMethod::READABLE,
            endpoint: "getMe",
        );
    }

    protected function getUpdates(array $options = []): object
    {
        return $this->request(
            method: HttpMethod::READABLE,
            endpoint: "getUpdates",
            params: $options
        );
    }
}
