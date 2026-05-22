<?php

namespace TGram\Interfaces\Chat;

interface HasChatManager
{
    public function kickChatMember(bool $revoke_messages = true): void;

    public function unbanChatMember(bool $only_if_banned = true): void;

    public function restrictChatMember(): void;

    public function promoteChatMember(array $permissions = []): void;

    public function getChat(): void;

    public function getChatMemberCount(): void;

    public function getChatAdministrators(): void;

    public function createChatInviteLink(
        string $name,
        int $expire_time,
        int $member_limit,
    ): void;

    public function setChatTitle(string $title): void;

    public function setChatPhoto(string $photo): void;
}
