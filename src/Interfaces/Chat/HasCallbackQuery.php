<?php

namespace TGram\Interfaces\Chat;

interface HasCallbackQuery
{
    public function answerCallbackQuery(
        ?string $text = null,
        bool $show_alert = false,
        ?string $url = null,
        ?int $cache_time = null
    ): object;

    public function answerInlineQuery(
        string $inlineQueryId,
        array $results,
        int $cache_time = 300,
        bool $is_personal = false,
        ?string $next_offset = null,
        ?array $button = null
    ): object;

    public static function switchInlineQuery(
        string $text,
        string $query
    ): array;
}
