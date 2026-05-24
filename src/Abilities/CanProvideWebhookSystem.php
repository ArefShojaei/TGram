<?php

namespace TGram\Abilities;

use TGram\Enums\HttpMethod;

trait CanProvideWebhookSystem
{
    public function setWebhook(
        string $url,
        ?string $secretToken = null,
        ?array $allowedUpdates = null,
    ): void {
        $params = [
            "url" => $url,
        ];

        if ($secretToken !== null) {
            $params["secret_token"] = $secretToken;
        }

        if ($allowedUpdates !== null) {
            $params["allowed_updates"] = json_encode($allowedUpdates);
        }

        $body = [
            "form_params" => $params,
        ];

        $this->request(
            method: HttpMethod::CREATABLE,
            endpoint: "setWebhook",
            params: $body,
        );
    }

    public function deleteWebhook(bool $dropPendingUpdates = false): void
    {
        $body = [
            "form_params" => [
                "drop_pending_updates" => $dropPendingUpdates,
            ],
        ];

        $this->request(
            method: HttpMethod::DELETABLE,
            endpoint: "deleteWebhook",
            params: $body,
        );
    }

    public function getWebhookInfo(): object
    {
        return $this->request(
            method: HttpMethod::READABLE,
            endpoint: "getWebhookInfo",
        );
    }

    public function setChatMenuButton(
        ?int $chatId = null,
        ?array $menuButton = null,
    ): void {
        $params = [];

        if ($chatId !== null) {
            $params["chat_id"] = $chatId;
        }

        if ($menuButton !== null) {
            $params["menu_button"] = json_encode($menuButton);
        }

        $body = [
            "form_params" => $params,
        ];

        $this->request(
            method: HttpMethod::UPDATABLE,
            endpoint: "setChatMenuButton",
            params: $body,
        );
    }

    public function setMyDefaultAdministratorRights(
        array $rights,
        bool $forChannels = false,
    ): void {
        $body = [
            "form_params" => [
                "rights" => json_encode($rights),
                "for_channels" => $forChannels,
            ],
        ];

        $this->request(
            method: HttpMethod::UPDATABLE,
            endpoint: "setMyDefaultAdministratorRights",
            params: $body,
        );
    }
}
