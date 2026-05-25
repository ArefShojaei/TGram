<?php

namespace TGram\Providers;

use TGram\Enums\{HttpMethod, MediaType};

trait HasChatManager
{
    public function kickChatMember(bool $revoke_messages = true): object
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "user_id" => $this->update->user->id,
                "revoke_messages" => $revoke_messages,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "kickChatMember",
            params: $body,
        );
    }

    public function unbanChatMember(bool $only_if_banned = true): object
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "user_id" => $this->update->user->id,
                "only_if_banned" => $only_if_banned,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "unbanChatMember",
            params: $body,
        );
    }

    public function restrictChatMember(): object
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

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "restrictChatMember",
            params: $body,
        );
    }

    public function promoteChatMember(array $permissions = []): object
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

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "promoteChatMember",
            params: $body,
        );
    }

    public function getChat(): object
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "getChat",
            params: $body,
        );
    }

    public function getChatMemberCount(): object
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "getChatMemberCount",
            params: $body,
        );
    }

    public function getChatAdministrators(): object
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "getChatAdministrators",
            params: $body,
        );
    }

    public function createChatInviteLink(
        string $name,
        int $expire_time,
        int $member_limit
    ): object {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "name" => $name,
                "expire_date" => $expire_time,
                "member_limit" => $member_limit,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "createChatInviteLink",
            params: $body,
        );
    }

    public function setChatTitle(string $title): object
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "title" => $title,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "setChatTitle",
            params: $body,
        );
    }

    public function setChatPhoto(string $photo): object
    {
        return $this->sendFile("setChatPhoto", $photo, MediaType::PHOTO);
    }

    public function deleteChatPhoto(): object
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "deleteChatPhoto",
            params: $body,
        );
    }

    public function setChatDescription(string $description): object
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "description" => $description,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "setChatDescription",
            params: $body,
        );
    }

    public function setChatPermissions(
        bool $can_send_messages = true,
        bool $can_send_audios = true,
        bool $can_send_documents = true,
        bool $can_send_photos = true,
        bool $can_send_videos = true,
        bool $can_send_video_notes = true,
        bool $can_send_voice_notes = true,
        bool $can_send_polls = true,
        bool $can_send_other_messages = true,
        bool $can_add_web_page_previews = true,
        bool $can_change_info = false,
        bool $can_invite_users = true,
        bool $can_pin_messages = false,
        bool $can_manage_topics = false
    ): object {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "permissions" => json_encode([
                    $can_send_messages,
                    $can_send_audios,
                    $can_send_documents,
                    $can_send_photos,
                    $can_send_videos,
                    $can_send_video_notes,
                    $can_send_voice_notes,
                    $can_send_polls,
                    $can_send_other_messages,
                    $can_add_web_page_previews,
                    $can_change_info,
                    $can_invite_users,
                    $can_pin_messages,
                    $can_manage_topics,
                ]),
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "setChatPermissions",
            params: $body,
        );
    }

    public function exportChatInviteLink(): ?string
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
            ],
        ];

        $response = $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "exportChatInviteLink",
            params: $body,
        );

        return $response["result"] ?? null;
    }

    public function leaveChat(): object
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "leaveChat",
            params: $body,
        );
    }
}
