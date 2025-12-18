<?php

namespace TGram\Abilities;

use TGram\Enums\{HttpMethod, Scope};


trait CanProvideCommandManager
{
    public function setCommands(array $commands, Scope $scope = Scope::DEFAULT): ?object
    {
        $body = [
            "json" => [
                "commands" => $commands,
                "scope" => ["type" => $scope->value],
            ],
        ];

        $response = $this->request(
            method: HttpMethod::CREATABLE,
            endpoint: "setMyCommands",
            params: $body,
        );

        return $response ?? null;
    }

    public function getCommands(Scope $scope = Scope::DEFAULT): ?object
    {
        $body = [
            "form_params" => [
                "scope" => ["type" => $scope->value],
            ],
        ];

        $response = $this->request(
            method: HttpMethod::READABLE,
            endpoint: "getMyCommands",
            params: $body,
        );

        return $response ?? null;
    }

    public function deleteCommands(Scope $scope = Scope::DEFAULT): ?object
    {
        $body = [
            "json" => [
                "scope" => ["type" => $scope->value],
            ],
        ];

        $response = $this->request(
            method: HttpMethod::CREATABLE,
            endpoint: "deleteMyCommands",
            params: $body,
        );

        return $response ?? null;
    }
}
