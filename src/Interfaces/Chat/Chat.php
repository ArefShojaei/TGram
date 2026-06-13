<?php

namespace TGram\Interfaces\Chat;

interface Chat
{
    public static function isPrivate(object $chat): bool;

    public static function isGroup(object $chat): bool;

    public static function isSupergroup(object $chat): bool;

    public static function isChannel(object $chat): bool;

    public static function isBot(object $user): bool;

    public static function getFullName(object $user): string;

    public static function getMentionLink(object $user): string;

    public static function getUserLink(object $user): string;

    public static function getUsername(
        object $user,
        bool $with_at = true,
    ): ?string;

    public static function isAdmin(object $chat_member): bool;

    public static function isMember(object $chat_member): bool;

    public static function isRestricted(object $chat_member): bool;

    public static function isBanned(object $chat_member): bool;

    public static function isLeft(object $chat_member): bool;
}
