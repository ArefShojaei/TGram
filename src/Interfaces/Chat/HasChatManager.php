<?php

namespace TGram\Interfaces\Chat;

interface HasChatManager
{
    public function banChatMember(
        bool $revoke_messages = true,
        ?int $until_date = null,
    ): object;

    public function unbanChatMember(
        bool $only_if_banned = true,
        ?int $chat_id = null,
        ?int $user_id = null,
    ): object;

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
    ): object;

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
    ): object;

    public function getChat(?int $chat_id = null): object;

    public function getChatMemberCount(?int $chat_id = null): object;

    public function getChatAdministrators(?int $chat_id = null): object;

    public function getChatMember(int $user_id, ?int $chat_id = null): object;

    public function createChatInviteLink(
        ?string $name = null,
        ?int $expire_date = null,
        ?int $member_limit = null,
        bool $creates_join_request = false,
    ): object;

    public function editChatInviteLink(
        string $invite_link,
        ?string $name = null,
        ?int $expire_date = null,
        ?int $member_limit = null,
        bool $creates_join_request = false,
    ): object;

    public function revokeChatInviteLink(
        string $invite_link,
        ?int $chat_id = null,
    ): object;

    public function setChatTitle(string $title): object;

    public function setChatPhoto(string $photo): object;

    public function deleteChatPhoto(): object;

    public function setChatDescription(
        string $description,
        ?int $chat_id = null,
    ): object;

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
    ): object;

    public function exportChatInviteLink(?int $chat_id = null): string;

    public function leaveChat(?int $chat_id = null): object;

    public function approveChatJoinRequest(
        int $user_id,
        ?int $chat_id = null,
    ): object;

    public function declineChatJoinRequest(
        int $user_id,
        ?int $chat_id = null,
    ): object;

    public function getUserProfilePhotos(
        int $user_id,
        ?int $offset = null,
        ?int $limit = null,
    ): object;
}
