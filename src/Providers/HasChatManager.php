<?php

namespace TGram\Providers;

use TGram\Enums\{HttpMethod, MediaType};


trait HasChatManager
{
    public function kickChatMember(bool $revoke_messages = true): void
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "user_id" => $this->update->user->id,
                "revoke_messages" => $revoke_messages,
            ],
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "kickChatMember",
            params: $body,
        );
    }

    public function unbanChatMember(bool $only_if_banned = true): void
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "user_id" => $this->update->user->id,
                "only_if_banned" => $only_if_banned,
            ],
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "unbanChatMember",
            params: $body,
        );
    }

    public function restrictChatMember(): void
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "user_id" => $this->update->user->id,
                "until_date" => time() * 86400,
                "permissions" => [
                    "can_send_messages" => false,
                    "can_send_media_messages" => false,
                    "can_send_polls" => false,
                    "can_send_other_messages" => false,
                    "can_add_web_page_previews" => false,
                    "can_change_info" => false,
                    "can_invite_users" => false,
                    "can_pin_messages" => false,
                ],
            ],
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "restrictChatMember",
            params: $body,
        );
    }

    public function promoteChatMember(array $permissions = []): void
    {
        $defaulPermissions = [
            "can_delete_messages" => true,
            "can_restrict_members" => true,
            "can_promote_members" => true,
            "can_change_info" => true,
            "can_invite_users" => true,
            "can_pin_messages" => true,
            "can_manage_topics" => true,
            "can_manage_video_chats" => true,
        ];

        $permissions = count($permissions) ? $permissions : $defaulPermissions;

        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "user_id" => $this->update->user->id,
                ...$permissions,
            ],
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "promoteChatMember",
            params: $body,
        );
    }

    public function getChat(): void
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
            ],
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "getChat",
            params: $body,
        );
    }

    public function getChatMemberCount(): void
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
            ],
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "getChatMemberCount",
            params: $body,
        );
    }

    public function getChatAdministrators(): void
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
            ],
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "getChatAdministrators",
            params: $body,
        );
    }

    public function createChatInviteLink(
        string $name,
        int $expire_time,
        int $member_limit,
    ): void {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "name" => $name,
                "expire_date" => $expire_time,
                "member_limit" => $member_limit,
            ],
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "createChatInviteLink",
            params: $body,
        );
    }

    public function setChatTitle(string $title): void
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "title" => $title,
            ],
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "setChatTitle",
            params: $body,
        );
    }

    public function setChatPhoto(string $photo): void
    {
        $this->sendFile("setChatPhoto", $photo, MediaType::PHOTO);
    }
}
