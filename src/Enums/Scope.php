<?php

namespace TGram\Enums;

enum Scope: string
{
    /**
     * Default scope for all users
     */
    case DEFAULT = "default";

    /**
     * All private chats
     */
    case ALL_PRIVATE_CHATS = "all_private_chats";

    /**
     * All group and supergroup chats
     */
    case ALL_GROUP_CHATS = "all_group_chats";

    /**
     * All chat administrators
     */
    case ALL_CHAT_ADMINISTRATORS = "all_chat_administrators";

    /**
     * Specific chat
     */
    case CHAT = "chat";

    /**
     * Specific chat administrators
     */
    case CHAT_ADMINISTRATORS = "chat_administrators";

    /**
     * Specific chat member
     */
    case CHAT_MEMBER = "chat_member";
}
