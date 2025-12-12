<?php

namespace TGram\Providers;

use TGram\Enums\{HttpMethod, ChatAction};


trait HasMediaSender
{
    public function sendLocation(
        float $latitude,
        float $longitude,
        ?int $live_period = null,
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $reply_to_message_id = null,
        ?array $reply_markup = null,
    ): void {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "latitude" => $latitude,
                "longitude" => $longitude,
                "live_period" => $live_period,
                "disable_notification" => $disable_notification,
                "protect_content" => $protect_content,
                "reply_to_message_id" => $reply_to_message_id,
                "reply_markup" => $reply_markup,
            ],
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
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $reply_to_message_id = null,
        ?array $reply_markup = null,
    ): void {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "phone_number" => $phone_number,
                "first_name" => $first_name,
                "last_name" => $last_name,
                "disable_notification" => $disable_notification,
                "protect_content" => $protect_content,
                "reply_to_message_id" => $reply_to_message_id,
                "reply_markup" => $reply_markup,
            ],
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
    ): void {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "question" => $question,
                "options" => json_encode($options),
                "is_anonymous" => $is_anonymous,
                "type" => $type,
                "allows_multiple_answers" => $allows_multiple_answers,
                "correct_option_id" => $correct_option_id,
                "explanation" => $explanation,
                "explanation_parse_mode" => $explanation_parse_mode,
                "open_period" => $open_period,
                "close_date" => $close_date,
                "is_closed" => $is_closed,
                "disable_notification" => $disable_notification,
                "protect_content" => $protect_content,
                "reply_to_message_id" => $reply_to_message_id,
                "reply_markup" => $reply_markup
                    ? json_encode($reply_markup)
                    : null,
            ],
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "sendPoll",
            params: $body,
        );
    }

    public function sendVenue(
        float $latitude,
        float $longitude,
        string $title,
        string $address,
        ?string $foursquare_id = null,
        ?string $foursquare_type = null,
        ?string $google_place_id = null,
        ?string $google_place_type = null,
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $reply_to_message_id = null,
        ?array $reply_markup = null
    ): void {
        $body = [
            "form_params" => [
                'chat_id'             => $this->update->chat->id,
                'latitude'            => $latitude,
                'longitude'           => $longitude,
                'title'               => $title,
                'address'             => $address,
                'foursquare_id'       => $foursquare_id,
                'foursquare_type'     => $foursquare_type,
                'google_place_id'     => $google_place_id,
                'google_place_type'    => $google_place_type,
                'disable_notification'=> $disable_notification,
                'protect_content'     => $protect_content,
                'reply_to_message_id' => $reply_to_message_id,
                'reply_markup'        => $reply_markup ? json_encode($reply_markup) : null,
            ]
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "sendVenue",
            params: $body,
        );
    }

    public function sendChatAction(ChatAction $action): void
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "action" => $action->value
            ]
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "sendChatAction",
            params: $body,
        );
    }

    public function sendInvoice(
        string $title,
        string $description,
        string $payload,
        string $provider_token,
        string $currency,
        array $prices,
        ?string $provider_data = null,
        ?string $photo_url = null,
        ?int $photo_size = null,
        ?int $photo_width = null,
        ?int $photo_height = null,
        ?string $suggested_tip_amounts = null,
        ?string $start_parameter = null,
        bool $need_name = false,
        bool $need_phone_number = false,
        bool $need_email = false,
        bool $need_shipping_address = false,
        bool $send_phone_number_to_provider = false,
        bool $send_email_to_provider = false,
        bool $is_flexible = false,
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $message_thread_id = null,
        ?int $reply_to_message_id = null,
        ?array $reply_markup = null
    ): void {
        $body = [
            "form_params" => [
                'chat_id'                       => $this->update->chat->id,
                'title'                         => $title,
                'description'                   => $description,
                'payload'                       => $payload,
                'provider_token'                => $provider_token,
                'currency'                      => $currency,
                'prices'                        => json_encode($prices),
                'provider_data'                 => $provider_data,
                'photo_url'                     => $photo_url,
                'photo_size'                    => $photo_size,
                'photo_width'                   => $photo_width,
                'photo_height'                  => $photo_height,
                'suggested_tip_amounts'         => $suggested_tip_amounts,
                'start_parameter'               => $start_parameter,
                'need_name'                     => $need_name,
                'need_phone_number'             => $need_phone_number,
                'need_email'                    => $need_email,
                'need_shipping_address'         => $need_shipping_address,
                'send_phone_number_to_provider' => $send_phone_number_to_provider,
                'send_email_to_provider'        => $send_email_to_provider,
                'is_flexible'                   => $is_flexible,
                'disable_notification'          => $disable_notification,
                'protect_content'               => $protect_content,
                'message_thread_id'             => $message_thread_id,
                'reply_to_message_id'           => $reply_to_message_id,
                'reply_markup'                  => $reply_markup ? json_encode($reply_markup) : null,
            ]
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "sendInvoice",
            params: $body,
        );
    }
}
