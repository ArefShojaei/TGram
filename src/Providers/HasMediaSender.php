<?php

namespace TGram\Providers;

use TGram\Enums\{HttpMethod, MediaType};


trait HasMediaSender
{
    use HasFileUploader;

    
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
        ?array $reply_markup = null,
    ): void {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "latitude" => $latitude,
                "longitude" => $longitude,
                "title" => $title,
                "address" => $address,
                "foursquare_id" => $foursquare_id,
                "foursquare_type" => $foursquare_type,
                "google_place_id" => $google_place_id,
                "google_place_type" => $google_place_type,
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
            endpoint: "sendVenue",
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
        ?array $reply_markup = null,
    ): void {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "title" => $title,
                "description" => $description,
                "payload" => $payload,
                "provider_token" => $provider_token,
                "currency" => $currency,
                "prices" => json_encode($prices),
                "provider_data" => $provider_data,
                "photo_url" => $photo_url,
                "photo_size" => $photo_size,
                "photo_width" => $photo_width,
                "photo_height" => $photo_height,
                "suggested_tip_amounts" => $suggested_tip_amounts,
                "start_parameter" => $start_parameter,
                "need_name" => $need_name,
                "need_phone_number" => $need_phone_number,
                "need_email" => $need_email,
                "need_shipping_address" => $need_shipping_address,
                "send_phone_number_to_provider" => $send_phone_number_to_provider,
                "send_email_to_provider" => $send_email_to_provider,
                "is_flexible" => $is_flexible,
                "disable_notification" => $disable_notification,
                "protect_content" => $protect_content,
                "message_thread_id" => $message_thread_id,
                "reply_to_message_id" => $reply_to_message_id,
                "reply_markup" => $reply_markup
                    ? json_encode($reply_markup)
                    : null,
            ],
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "sendInvoice",
            params: $body,
        );
    }

    public function sendPhoto(
        string $photo,
        ?string $caption = null,
        ?string $parse_mode = "HTML",
        ?array $caption_entities = null,
        bool $show_caption_above_media = false,
        bool $has_spoiler = false,
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $reply_to_message_id = null,
        ?array $reply_markup = null,
        ?int $direct_messages_topic_id = null,
        ?array $suggested_post_parameters = null,
        ?string $business_connection_id = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
    ): void {
        $body = [
            "chat_id" => $this->update->chat->id,
            "caption" => $caption,
            "parse_mode" => $parse_mode,
            "caption_entities" => $caption_entities
                ? json_encode($caption_entities)
                : null,
            "show_caption_above_media" => $show_caption_above_media,
            "has_spoiler" => $has_spoiler,
            "disable_notification" => $disable_notification,
            "protect_content" => $protect_content,
            "reply_to_message_id" => $reply_to_message_id,
            "reply_markup" => $reply_markup ? json_encode($reply_markup) : null,
            "direct_messages_topic_id" => $direct_messages_topic_id,
            "suggested_post_parameters" => $suggested_post_parameters
                ? json_encode($suggested_post_parameters)
                : null,
            "business_connection_id" => $business_connection_id,
            "allow_paid_broadcast" => $allow_paid_broadcast,
            "message_effect_id" => $message_effect_id,
        ];

        $this->sendFile("sendPhoto", $photo, MediaType::PHOTO, $body);
    }

    public function sendAudio(
        string $audio,
        ?string $caption = null,
        ?string $parse_mode = "HTML",
        ?array $caption_entities = null,
        ?int $duration = null,
        ?string $performer = null,
        ?string $title = null,
        ?string $thumbnail = null,
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $message_thread_id = null,
        ?int $reply_to_message_id = null,
        ?array $reply_markup = null,
        ?int $direct_messages_topic_id = null,
        ?array $suggested_post_parameters = null,
        ?string $business_connection_id = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
    ): void {
        $body = [
            "chat_id" => $this->update->chat->id,
            "caption" => $caption,
            "parse_mode" => $parse_mode,
            "caption_entities" => $caption_entities
                ? json_encode($caption_entities)
                : null,
            "duration" => $duration,
            "performer" => $performer,
            "title" => $title,
            "disable_notification" => $disable_notification,
            "protect_content" => $protect_content,
            "message_thread_id" => $message_thread_id,
            "reply_to_message_id" => $reply_to_message_id,
            "reply_markup" => $reply_markup ? json_encode($reply_markup) : null,
            "direct_messages_topic_id" => $direct_messages_topic_id,
            "suggested_post_parameters" => $suggested_post_parameters
                ? json_encode($suggested_post_parameters)
                : null,
            "business_connection_id" => $business_connection_id,
            "allow_paid_broadcast" => $allow_paid_broadcast,
            "message_effect_id" => $message_effect_id,
        ];

        $this->sendFile("sendAudio", $audio, MediaType::AUDIO, $body);
    }

    public function sendDocument(
        string $document,
        ?string $thumbnail = null,
        ?string $caption = null,
        ?string $parse_mode = "HTML",
        ?array $caption_entities = null,
        bool $disable_content_type_detection = false,
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $message_thread_id = null,
        ?int $reply_to_message_id = null,
        ?array $reply_markup = null,
        ?int $direct_messages_topic_id = null,
        ?array $suggested_post_parameters = null,
        ?string $business_connection_id = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
    ): void {
        $body = [
            "chat_id" => $this->update->chat->id,
            "caption" => $caption,
            "parse_mode" => $parse_mode,
            "caption_entities" => $caption_entities
                ? json_encode($caption_entities)
                : null,
            "disable_content_type_detection" => $disable_content_type_detection,
            "disable_notification" => $disable_notification,
            "protect_content" => $protect_content,
            "message_thread_id" => $message_thread_id,
            "reply_to_message_id" => $reply_to_message_id,
            "reply_markup" => $reply_markup ? json_encode($reply_markup) : null,
            "direct_messages_topic_id" => $direct_messages_topic_id,
            "suggested_post_parameters" => $suggested_post_parameters
                ? json_encode($suggested_post_parameters)
                : null,
            "business_connection_id" => $business_connection_id,
            "allow_paid_broadcast" => $allow_paid_broadcast,
            "message_effect_id" => $message_effect_id,
        ];

        $this->sendFile("sendDocument", $document, MediaType::DOCUMENT, $body);
    }

    public function sendVideo(
        string $video,
        ?int $duration = null,
        ?int $width = null,
        ?int $height = null,
        ?string $thumbnail = null,
        ?string $caption = null,
        ?string $parse_mode = "HTML",
        ?array $caption_entities = null,
        bool $show_caption_above_media = false,
        bool $has_spoiler = false,
        bool $supports_streaming = false,
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $message_thread_id = null,
        ?int $reply_to_message_id = null,
        ?array $reply_markup = null,
        ?int $direct_messages_topic_id = null,
        ?array $suggested_post_parameters = null,
        ?string $business_connection_id = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        ?int $start_timestamp = null,
        ?string $cover = null,
    ): void {
        $body = [
            "chat_id" => $this->update->chat->id,
            "duration" => $duration,
            "width" => $width,
            "height" => $height,
            "caption" => $caption,
            "parse_mode" => $parse_mode,
            "caption_entities" => $caption_entities
                ? json_encode($caption_entities)
                : null,
            "show_caption_above_media" => $show_caption_above_media,
            "has_spoiler" => $has_spoiler,
            "supports_streaming" => $supports_streaming,
            "disable_notification" => $disable_notification,
            "protect_content" => $protect_content,
            "message_thread_id" => $message_thread_id,
            "reply_to_message_id" => $reply_to_message_id,
            "reply_markup" => $reply_markup ? json_encode($reply_markup) : null,
            "direct_messages_topic_id" => $direct_messages_topic_id,
            "suggested_post_parameters" => $suggested_post_parameters
                ? json_encode($suggested_post_parameters)
                : null,
            "business_connection_id" => $business_connection_id,
            "allow_paid_broadcast" => $allow_paid_broadcast,
            "message_effect_id" => $message_effect_id,
            "start_timestamp" => $start_timestamp,
        ];

        $this->sendFile("sendVideo", $video, MediaType::VIDEO, $body);
    }

    public function sendAnimation(
        string $animation,
        ?int $duration = null,
        ?int $width = null,
        ?int $height = null,
        ?string $thumbnail = null,
        ?string $caption = null,
        ?string $parse_mode = "HTML",
        ?array $caption_entities = null,
        bool $show_caption_above_media = false,
        bool $has_spoiler = false,
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $message_thread_id = null,
        ?int $reply_to_message_id = null,
        ?array $reply_markup = null,
        ?int $direct_messages_topic_id = null,
        ?array $suggested_post_parameters = null,
        ?string $business_connection_id = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
    ): void {
        $body = [
            "chat_id" => $this->update->chat->id,
            "duration" => $duration,
            "width" => $width,
            "height" => $height,
            "caption" => $caption,
            "parse_mode" => $parse_mode,
            "caption_entities" => $caption_entities
                ? json_encode($caption_entities)
                : null,
            "show_caption_above_media" => $show_caption_above_media,
            "has_spoiler" => $has_spoiler,
            "disable_notification" => $disable_notification,
            "protect_content" => $protect_content,
            "message_thread_id" => $message_thread_id,
            "reply_to_message_id" => $reply_to_message_id,
            "reply_markup" => $reply_markup ? json_encode($reply_markup) : null,
            "direct_messages_topic_id" => $direct_messages_topic_id,
            "suggested_post_parameters" => $suggested_post_parameters
                ? json_encode($suggested_post_parameters)
                : null,
            "business_connection_id" => $business_connection_id,
            "allow_paid_broadcast" => $allow_paid_broadcast,
            "message_effect_id" => $message_effect_id,
        ];

        $this->sendFile("sendAnimation", $animation, MediaType::GIFT, $body);
    }

    public function sendSticker(
        string $sticker,
        ?string $emoji = null,
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $message_thread_id = null,
        ?int $reply_to_message_id = null,
        ?array $reply_markup = null,
        ?int $direct_messages_topic_id = null,
        ?array $suggested_post_parameters = null,
        ?string $business_connection_id = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
    ): void {
        $body = [
            "chat_id" => $this->update->chat->id,
            "emoji" => $emoji,
            "disable_notification" => $disable_notification,
            "protect_content" => $protect_content,
            "message_thread_id" => $message_thread_id,
            "reply_to_message_id" => $reply_to_message_id,
            "reply_markup" => $reply_markup ? json_encode($reply_markup) : null,
            "direct_messages_topic_id" => $direct_messages_topic_id,
            "suggested_post_parameters" => $suggested_post_parameters
                ? json_encode($suggested_post_parameters)
                : null,
            "business_connection_id" => $business_connection_id,
            "allow_paid_broadcast" => $allow_paid_broadcast,
            "message_effect_id" => $message_effect_id,
        ];

        $this->sendFile("sendSticker", $sticker, MediaType::STICKER, $body);
    }
}
