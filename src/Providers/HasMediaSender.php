<?php

namespace TGram\Providers;

use TGram\Enums\HttpMethod;


trait HasMediaSender
{
    public function sendLocation(
        float $latitude,
        float $longitude,
        ?float $horizontal_accuracy = null,
        ?int $live_period = null,
        ?int $heading = null,
        ?int $proximity_alert_radius = null,
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $reply_to_message_id = null,
        ?array $reply_markup = null,
        ?int $message_thread_id = null,
    ): void {
        $body = [
            "form_params" => [
                'chat_id'                  => $this->update->chat->id,
                'latitude'                 => $latitude,
                'longitude'                => $longitude,
                'horizontal_accuracy'      => $horizontal_accuracy,
                'live_period'              => $live_period,
                'heading'                  => $heading,
                'proximity_alert_radius'   => $proximity_alert_radius,
                'disable_notification'     => $disable_notification,
                'protect_content'          => $protect_content,
                'message_thread_id'        => $message_thread_id,
                'reply_to_message_id'      => $reply_to_message_id,
                'reply_markup'             => $reply_markup,
            ]
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "sendLocation",
            params: $body,
        );
    }

    public function sendContact(
        string $phone_number,
        string $first_name,
        ?string $last_name = null,
        ?string $vcard = null,
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $reply_to_message_id = null,
        ?array $reply_markup = null,
        ?int $message_thread_id = null,
    ): void {
        $body = [
            "form_params" => [
                'chat_id'              => $this->update->chat->id,
                'phone_number'         => $phone_number,
                'first_name'           => $first_name,
                'last_name'            => $last_name,
                'vcard'                => $vcard,
                'disable_notification' => $disable_notification,
                'protect_content'      => $protect_content,
                'message_thread_id'    => $message_thread_id,
                'reply_to_message_id'  => $reply_to_message_id,
                'reply_markup'         => $reply_markup,
            ]
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "sendContact",
            params: $body,
        );
    }

    public function sendPoll(
        string $question,
        array $options,
        bool $is_anonymous = true,
        string $type = "regular",
        bool $allows_multiple_answers = false,
        ?int $correct_option_id = null,
        ?string $explanation = null,
        ?string $explanation_parse_mode = "HTML",
        ?int $open_period = null,
        ?int $close_date = null,
        bool $is_closed = false,
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $reply_to_message_id = null,
        ?array $reply_markup = null,
        ?int $message_thread_id = null,
    ): void {
        $body = [
            "form_params" => [
                'chat_id'                   => $this->update->chat->id,
                'question'                  => $question,
                'options'                   => json_encode($options),
                'is_anonymous'              => $is_anonymous,
                'type'                      => $type,
                'allows_multiple_answers'   => $allows_multiple_answers,
                'correct_option_id'         => $correct_option_id,
                'explanation'               => $explanation,
                'explanation_parse_mode'    => $explanation_parse_mode,
                'open_period'               => $open_period,
                'close_date'                => $close_date,
                'is_closed'                 => $is_closed,
                'disable_notification'      => $disable_notification,
                'protect_content'           => $protect_content,
                'message_thread_id'         => $message_thread_id,
                'reply_to_message_id'       => $reply_to_message_id,
                'reply_markup'              => $reply_markup ? json_encode($reply_markup) : null,
            ]
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "sendPoll",
            params: $body,
        );
    }
}
