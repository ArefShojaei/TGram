<?php

namespace TGram\Interfaces;

interface Webhook
{
    public function setWebhook(
        string $url,
        ?string $secretToken = null,
        ?array $allowedUpdates = null
    ): object;

    public function deleteWebhook(bool $dropPendingUpdates = false): object;

    public function getWebhookInfo(): object;

    public function setChatMenuButton(
        ?int $chatId = null,
        ?array $menuButton = null
    ): object;

    public function setMyDefaultAdministratorRights(
        array $rights,
        bool $forChannels = false
    ): object;
}
