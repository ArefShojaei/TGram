<?php

namespace TGram\Providers;

use TGram\Enums\HttpMethod;
use TGram\Exceptions\ValidationException;

trait HasCallbackQuery
{
    public function answerCallbackQuery(
        ?string $text = null,
        bool $show_alert = false,
        ?string $url = null,
        ?int $cache_time = null
    ): object {
        $body = [
            "form_params" => [
                "callback_query_id" => $this->update->callback_id,
                "text" => $text,
                "show_alert" => $show_alert,
                "url" => $url,
                "cache_time" => $cache_time,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "answerCallbackQuery",
            params: $body,
        );
    }

    public function answerInlineQuery(
        string $inlineQueryId,
        array $results,
        int $cache_time = 300,
        bool $is_personal = false,
        ?string $next_offset = null,
        ?array $button = null
    ): object {
        if (empty($results)) {
            throw new ValidationException("Results array cannot be empty");
        }

        $body = [
            "form_params" => [
                "inline_query_id" => $inlineQueryId,
                "results" => json_encode($results),
                "cache_time" => $cache_time,
                "is_personal" => $is_personal,
                "next_offset" => $next_offset,
                "button" => $button ? json_encode($button) : null,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "answerInlineQuery",
            params: $body,
        );
    }

    public static function switchInlineQuery(string $text, string $query): array
    {
        return [
            "text" => $text,
            "switch_inline_query" => $query,
        ];
    }
}
