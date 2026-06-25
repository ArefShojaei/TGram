<?php

namespace TGram\Providers;

use TGram\Enums\{HttpMethod, MediaType};
use TGram\Exceptions\ValidationException;

trait HasMediaSender
{
    private const LATITUDE_MIN = -90;
    private const LATITUDE_MAX = 90;

    private const LONGITUDE_MIN = -180;
    private const LONGITUDE_MAX = 180;

    use HasFileUploader;

    public function sendLocation(
        float $latitude,
        float $longitude,
        ?int $live_period = null,
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $reply_to_message_id = null,
        ?int $message_thread_id = null,
        ?array $reply_markup = null,
    ): object {
        if (!is_numeric($latitude) || !is_numeric($longitude)) {
            throw new ValidationException(
                "Latitude and Longitude must be numeric",
            );
        }

        if ($latitude < self::LATITUDE_MIN || $latitude > self::LATITUDE_MAX) {
            throw new ValidationException(
                "Latitude must be between -90 and 90",
            );
        }

        if (
            $longitude < self::LONGITUDE_MIN ||
            $longitude > self::LONGITUDE_MAX
        ) {
            throw new ValidationException(
                "Longitude must be between -180 and 180",
            );
        }

        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "latitude" => $latitude,
                "longitude" => $longitude,
                "live_period" => $live_period,
                "disable_notification" => $disable_notification,
                "protect_content" => $protect_content,
                "reply_to_message_id" => $reply_to_message_id,
                "message_thread_id" => $message_thread_id,
                "reply_markup" => $reply_markup
                    ? json_encode($reply_markup)
                    : null,
            ],
        ];

        return $this->bot->request(
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
        ?int $message_thread_id = null,
        ?array $reply_markup = null,
    ): object {
        if (empty(trim($phone_number))) {
            throw new ValidationException("Phone number cannot be empty");
        }

        if (empty(trim($first_name))) {
            throw new ValidationException("First name cannot be empty");
        }

        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "phone_number" => $phone_number,
                "first_name" => $first_name,
                "last_name" => $last_name,
                "vcard" => $vcard,
                "disable_notification" => $disable_notification,
                "protect_content" => $protect_content,
                "reply_to_message_id" => $reply_to_message_id,
                "message_thread_id" => $message_thread_id,
                "reply_markup" => $reply_markup
                    ? json_encode($reply_markup)
                    : null,
            ],
        ];

        return $this->bot->request(
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
        ?string $explanation_parse_mode = null,
        ?array $explanation_entities = null,
        ?int $open_period = null,
        ?int $close_date = null,
        bool $is_closed = false,
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $message_thread_id = null,
        ?int $reply_to_message_id = null,
        ?array $reply_markup = null,
    ): object {
        if (empty(trim($question))) {
            throw new ValidationException("Poll question cannot be empty");
        }

        if (count($options) < 2) {
            throw new ValidationException("Poll must have at least 2 options");
        }

        if (count($options) > 10) {
            throw new ValidationException(
                "Poll cannot have more than 10 options",
            );
        }

        // ✅ Validate option content
        foreach ($options as $option) {
            if (is_string($option)) {
                if (empty(trim($option))) {
                    throw new ValidationException(
                        "Poll option cannot be empty",
                    );
                }
            }
        }

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
                "explanation_entities" => $explanation_entities
                    ? json_encode($explanation_entities)
                    : null,
                "open_period" => $open_period,
                "close_date" => $close_date,
                "is_closed" => $is_closed,
                "disable_notification" => $disable_notification,
                "protect_content" => $protect_content,
                "message_thread_id" => $message_thread_id,
                "reply_to_message_id" => $reply_to_message_id,
                "reply_markup" => $reply_markup
                    ? json_encode($reply_markup)
                    : null,
            ],
        ];

        return $this->bot->request(
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
        ?int $message_thread_id = null,
        ?int $reply_to_message_id = null,
        ?array $reply_markup = null,
    ): object {
        if (!is_numeric($latitude) || !is_numeric($longitude)) {
            throw new ValidationException(
                "Latitude and Longitude must be numeric",
            );
        }

        if (empty(trim($title))) {
            throw new ValidationException("Venue title cannot be empty");
        }

        if (empty(trim($address))) {
            throw new ValidationException("Venue address cannot be empty");
        }

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
                "message_thread_id" => $message_thread_id,
                "reply_to_message_id" => $reply_to_message_id,
                "reply_markup" => $reply_markup
                    ? json_encode($reply_markup)
                    : null,
            ],
        ];

        return $this->bot->request(
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
        ?array $suggested_tip_amounts = null,
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
    ): object {
        if (empty(trim($title))) {
            throw new ValidationException("Invoice title cannot be empty");
        }

        if (empty($prices) || !is_array($prices)) {
            throw new ValidationException("Prices must be a non-empty array");
        }

        if (empty(trim($currency))) {
            throw new ValidationException("Currency cannot be empty");
        }

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
                "suggested_tip_amounts" => $suggested_tip_amounts
                    ? json_encode($suggested_tip_amounts)
                    : null,
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

        return $this->bot->request(
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
        ?int $message_thread_id = null,
        ?int $reply_to_message_id = null,
        ?array $reply_markup = null,
        ?int $direct_messages_topic_id = null,
        ?array $suggested_post_parameters = null,
        ?string $business_connection_id = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
    ): object {
        $body = [
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

        return $this->sendFile("sendPhoto", $photo, MediaType::PHOTO, $body);
    }

    public function sendAudio(
        string $audio,
        ?string $caption = null,
        ?string $parse_mode = "HTML",
        ?array $caption_entities = null,
        ?int $duration = null,
        ?string $performer = null,
        ?string $title = null,
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
    ): object {
        $body = [
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

        return $this->sendFile("sendAudio", $audio, MediaType::AUDIO, $body);
    }

    public function sendDocument(
        string $document,
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
    ): object {
        $body = [
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

        return $this->sendFile(
            "sendDocument",
            $document,
            MediaType::DOCUMENT,
            $body,
        );
    }

    public function sendVideo(
        string $video,
        ?int $duration = null,
        ?int $width = null,
        ?int $height = null,
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
    ): object {
        $body = [
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

        return $this->sendFile("sendVideo", $video, MediaType::VIDEO, $body);
    }

    public function sendAnimation(
        string $animation,
        ?int $duration = null,
        ?int $width = null,
        ?int $height = null,
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
    ): object {
        $body = [
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

        return $this->sendFile(
            "sendAnimation",
            $animation,
            MediaType::GIFT,
            $body,
        );
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
    ): object {
        $body = [
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

        return $this->sendFile(
            "sendSticker",
            $sticker,
            MediaType::STICKER,
            $body,
        );
    }

    public function sendVoice(
        string $voice,
        ?string $caption = null,
        ?string $parse_mode = "HTML",
        ?array $caption_entities = null,
        ?int $duration = null,
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $message_thread_id = null,
        ?int $reply_to_message_id = null,
        ?array $reply_markup = null,
        ?string $business_connection_id = null,
        ?string $message_effect_id = null,
    ): object {
        $body = [
            "caption" => $caption,
            "parse_mode" => $parse_mode,
            "caption_entities" => $caption_entities
                ? json_encode($caption_entities)
                : null,
            "duration" => $duration,
            "disable_notification" => $disable_notification,
            "protect_content" => $protect_content,
            "message_thread_id" => $message_thread_id,
            "reply_to_message_id" => $reply_to_message_id,
            "reply_markup" => $reply_markup ? json_encode($reply_markup) : null,
            "business_connection_id" => $business_connection_id,
            "message_effect_id" => $message_effect_id,
        ];

        return $this->sendFile("sendVoice", $voice, MediaType::VOICE, $body);
    }

    public function sendVideoNote(
        string $video_note,
        ?int $duration = null,
        ?int $length = null,
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $message_thread_id = null,
        ?int $reply_to_message_id = null,
        ?array $reply_markup = null,
        ?string $business_connection_id = null,
        ?string $message_effect_id = null,
    ): object {
        $body = [
            "duration" => $duration,
            "length" => $length,
            "disable_notification" => $disable_notification,
            "protect_content" => $protect_content,
            "message_thread_id" => $message_thread_id,
            "reply_to_message_id" => $reply_to_message_id,
            "reply_markup" => $reply_markup ? json_encode($reply_markup) : null,
            "business_connection_id" => $business_connection_id,
            "message_effect_id" => $message_effect_id,
        ];

        return $this->sendFile(
            "sendVideoNote",
            $video_note,
            MediaType::VOICE_NOTE,
            $body,
        );
    }

    public function sendMediaGroup(
        array $media,
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $message_thread_id = null,
        ?int $reply_to_message_id = null,
        ?string $business_connection_id = null,
    ): object {
        if (empty($media)) {
            throw new ValidationException("Media array cannot be empty");
        }

        if (count($media) < 2) {
            throw new ValidationException(
                "Media group must have at least 2 items",
            );
        }

        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "media" => json_encode($media),
                "disable_notification" => $disable_notification,
                "protect_content" => $protect_content,
                "message_thread_id" => $message_thread_id,
                "reply_to_message_id" => $reply_to_message_id,
                "business_connection_id" => $business_connection_id,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "sendMediaGroup",
            params: $body,
        );
    }

    public function sendDice(
        ?string $emoji = "🎲",
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $message_thread_id = null,
        ?int $reply_to_message_id = null,
        ?array $reply_markup = null,
        ?string $business_connection_id = null,
        ?string $message_effect_id = null,
    ): object {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "emoji" => $emoji,
                "disable_notification" => $disable_notification,
                "protect_content" => $protect_content,
                "message_thread_id" => $message_thread_id,
                "reply_to_message_id" => $reply_to_message_id,
                "reply_markup" => $reply_markup
                    ? json_encode($reply_markup)
                    : null,
                "business_connection_id" => $business_connection_id,
                "message_effect_id" => $message_effect_id,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "sendDice",
            params: $body,
        );
    }

    public function setMessageReaction(
        int $message_id,
        ?array $reaction = null,
        bool $is_big = false,
    ): object {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "message_id" => $message_id,
                "reaction" => $reaction ? json_encode($reaction) : null,
                "is_big" => $is_big,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "setMessageReaction",
            params: $body,
        );
    }
}
