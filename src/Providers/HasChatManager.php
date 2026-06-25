<?php

namespace TGram\Providers;

use TGram\Enums\{HttpMethod, MediaType};
use TGram\Exceptions\ValidationException;

trait HasChatManager
{
    public function banChatMember(
        bool $revoke_messages = true,
        ?int $until_date = null,
    ): object {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "user_id" => $this->update->user->id,
                "revoke_messages" => $revoke_messages,
                "until_date" => $until_date,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "banChatMember",
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

    public function restrictChatMember(
        bool $can_send_messages = false,
        bool $can_send_audios = false,
        bool $can_send_documents = false,
        bool $can_send_photos = false,
        bool $can_send_videos = false,
        bool $can_send_video_notes = false,
        bool $can_send_voice_notes = false,
        bool $can_send_polls = false,
        bool $can_send_other_messages = false,
        bool $can_add_web_page_previews = false,
        bool $can_change_info = false,
        bool $can_invite_users = false,
        bool $can_pin_messages = false,
        bool $can_manage_topics = false,
        ?int $until_date = null,
        bool $use_independent_chat_permissions = false,
    ): object {
        $permissions = [
            "can_send_messages" => $can_send_messages,
            "can_send_audios" => $can_send_audios,
            "can_send_documents" => $can_send_documents,
            "can_send_photos" => $can_send_photos,
            "can_send_videos" => $can_send_videos,
            "can_send_video_notes" => $can_send_video_notes,
            "can_send_voice_notes" => $can_send_voice_notes,
            "can_send_polls" => $can_send_polls,
            "can_send_other_messages" => $can_send_other_messages,
            "can_add_web_page_previews" => $can_add_web_page_previews,
            "can_change_info" => $can_change_info,
            "can_invite_users" => $can_invite_users,
            "can_pin_messages" => $can_pin_messages,
            "can_manage_topics" => $can_manage_topics,
        ];

        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "user_id" => $this->update->user->id,
                "permissions" => json_encode($permissions),
                "until_date" => $until_date,
                "use_independent_chat_permissions" => $use_independent_chat_permissions,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "restrictChatMember",
            params: $body,
        );
    }

    public function promoteChatMember(
        bool $is_anonymous = false,
        bool $can_manage_chat = false,
        bool $can_delete_messages = false,
        bool $can_manage_voice_chats = false,
        bool $can_restrict_members = false,
        bool $can_promote_members = false,
        bool $can_change_info = false,
        bool $can_invite_users = false,
        bool $can_post_stories = false,
        bool $can_edit_stories = false,
        bool $can_delete_stories = false,
        bool $can_post_messages = false,
        bool $can_edit_messages = false,
        bool $can_pin_messages = false,
        bool $can_manage_topics = false,
    ): object {
        $permissions = [
            "is_anonymous" => $is_anonymous,
            "can_manage_chat" => $can_manage_chat,
            "can_delete_messages" => $can_delete_messages,
            "can_manage_voice_chats" => $can_manage_voice_chats,
            "can_restrict_members" => $can_restrict_members,
            "can_promote_members" => $can_promote_members,
            "can_change_info" => $can_change_info,
            "can_invite_users" => $can_invite_users,
            "can_post_stories" => $can_post_stories,
            "can_edit_stories" => $can_edit_stories,
            "can_delete_stories" => $can_delete_stories,
            "can_post_messages" => $can_post_messages,
            "can_edit_messages" => $can_edit_messages,
            "can_pin_messages" => $can_pin_messages,
            "can_manage_topics" => $can_manage_topics,
        ];

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
            method: HttpMethod::READABLE,
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
            method: HttpMethod::READABLE,
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
            method: HttpMethod::READABLE,
            endpoint: "getChatAdministrators",
            params: $body,
        );
    }

    public function getChatMember(int $user_id): object
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "user_id" => $user_id,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::READABLE,
            endpoint: "getChatMember",
            params: $body,
        );
    }

    public function createChatInviteLink(
        ?string $name = null,
        ?int $expire_date = null,
        ?int $member_limit = null,
        bool $creates_join_request = false,
    ): object {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "name" => $name,
                "expire_date" => $expire_date,
                "member_limit" => $member_limit,
                "creates_join_request" => $creates_join_request,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "createChatInviteLink",
            params: $body,
        );
    }

    public function editChatInviteLink(
        string $invite_link,
        ?string $name = null,
        ?int $expire_date = null,
        ?int $member_limit = null,
        bool $creates_join_request = false,
    ): object {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "invite_link" => $invite_link,
                "name" => $name,
                "expire_date" => $expire_date,
                "member_limit" => $member_limit,
                "creates_join_request" => $creates_join_request,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::UPDATABLE,
            endpoint: "editChatInviteLink",
            params: $body,
        );
    }

    public function revokeChatInviteLink(string $invite_link): object
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "invite_link" => $invite_link,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "revokeChatInviteLink",
            params: $body,
        );
    }

    public function setChatTitle(string $title): object
    {
        if (empty(trim($title))) {
            throw new ValidationException("Chat title cannot be empty");
        }

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
        return $this->sendFile("setChatPhoto", $photo, MediaType::PHOTO, []);
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
        bool $can_send_messages = false,
        bool $can_send_audios = false,
        bool $can_send_documents = false,
        bool $can_send_photos = false,
        bool $can_send_videos = false,
        bool $can_send_video_notes = false,
        bool $can_send_voice_notes = false,
        bool $can_send_polls = false,
        bool $can_send_other_messages = false,
        bool $can_add_web_page_previews = false,
        bool $can_change_info = false,
        bool $can_invite_users = false,
        bool $can_pin_messages = false,
        bool $can_manage_topics = false,
        bool $use_independent_chat_permissions = false,
    ): object {
        $permissions = [
            "can_send_messages" => $can_send_messages,
            "can_send_audios" => $can_send_audios,
            "can_send_documents" => $can_send_documents,
            "can_send_photos" => $can_send_photos,
            "can_send_videos" => $can_send_videos,
            "can_send_video_notes" => $can_send_video_notes,
            "can_send_voice_notes" => $can_send_voice_notes,
            "can_send_polls" => $can_send_polls,
            "can_send_other_messages" => $can_send_other_messages,
            "can_add_web_page_previews" => $can_add_web_page_previews,
            "can_change_info" => $can_change_info,
            "can_invite_users" => $can_invite_users,
            "can_pin_messages" => $can_pin_messages,
            "can_manage_topics" => $can_manage_topics,
        ];

        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "permissions" => json_encode($permissions),
                "use_independent_chat_permissions" => $use_independent_chat_permissions,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "setChatPermissions",
            params: $body,
        );
    }

    public function exportChatInviteLink(): string
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

        if (!isset($response->result) || !is_string($response->result)) {
            throw new ValidationException(
                "Invalid response from exportChatInviteLink",
            );
        }

        return $response->result;
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

    public function approveChatJoinRequest(int $user_id): object
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "user_id" => $user_id,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "approveChatJoinRequest",
            params: $body,
        );
    }

    public function declineChatJoinRequest(int $user_id): object
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "user_id" => $user_id,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "declineChatJoinRequest",
            params: $body,
        );
    }

    public function getUserProfilePhotos(
        int $user_id,
        ?int $offset = null,
        ?int $limit = null,
    ): object {
        $body = [
            "form_params" => [
                "user_id" => $user_id,
                "offset" => $offset,
                "limit" => $limit,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::READABLE,
            endpoint: "getUserProfilePhotos",
            params: $body,
        );
    }
}
