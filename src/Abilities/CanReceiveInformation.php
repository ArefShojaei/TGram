<?php

namespace TGram\Abilities;


trait CanReceiveInformation
{
    public function getMe(): object
    {
        return $this->request("getMe");
    }

    public function getUpdates(array $options = []): object
    {
        return $this->request(endpoint: "getUpdates", options: $options);
    }
}
