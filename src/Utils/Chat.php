<?php

namespace TGram\Utils;

use TGram\Interfaces\Chat\Chat as IChat;

final class Chat implements IChat
{
    public static function isPrivate(object $chat): bool
    {
        return $chat->type === "private";
    }

    public static function isGroup(object $chat): bool
    {
        return $chat->type === "group";
    }

    public static function isSupergroup(object $chat): bool
    {
        return $chat->type === "supergroup";
    }

    public static function isChannel(object $chat): bool
    {
        return $chat->type === "channel";
    }

    public static function isBot(object $user): bool
    {
        return $user->is_bot ?? false;
    }

    public static function getFullName(object $user): string
    {
        $name = $user->first_name ?? "";

        if (!empty($user->last_name)) {
            $name .= " " . $user->last_name;
        }

        return trim($name);
    }

    public static function getMentionLink(object $user): string
    {
        if (!empty($user->username)) {
            return "@{$user->username}";
        }

        return "[" . self::getFullName($user) . "](tg://user?id={$user->id})";
    }

    public static function getUserLink(object $user): string
    {
        return !empty($user->username)
            ? "https://t.me/{$user->username}"
            : "tg://user?id={$user->id}";
    }

    public static function getUsername(
        object $user,
        bool $with_at = true,
    ): ?string {
        if (empty($user->username)) {
            return null;
        }

        return $with_at ? "@{$user->username}" : $user->username;
    }

    public static function isAdmin(object $chat_member): bool
    {
        return in_array($chat_member->status ?? null, [
            "creator",
            "administrator",
        ]);
    }

    public static function isMember(object $chat_member): bool
    {
        return $chat_member->status === "member";
    }

    public static function isRestricted(object $chat_member): bool
    {
        return $chat_member->status === "restricted";
    }

    public static function isBanned(object $chat_member): bool
    {
        return $chat_member->status === "kicked";
    }

    public static function isLeft(object $chat_member): bool
    {
        return $chat_member->status === "left";
    }
}
