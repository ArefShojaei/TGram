<?php

namespace TGram\Interfaces\Chat;

interface HasChatManager
{
    public function kickChatMember(bool $revoke_messages = true): object;

    public function unbanChatMember(bool $only_if_banned = true): object;

    public function restrictChatMember(): object;

    public function promoteChatMember(array $permissions = []): object;

    public function getChat(): object;

    public function getChatMemberCount(): object;

    public function getChatAdministrators(): object;

    public function createChatInviteLink(
        string $name,
        int $expire_time,
        int $member_limit
    ): object;

    public function setChatTitle(string $title): object;

    public function setChatPhoto(string $photo): object;
}
