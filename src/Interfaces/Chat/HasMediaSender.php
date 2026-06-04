<?php

namespace TGram\Interfaces\Chat;

interface HasMediaSender
{
    public function sendLocation(
        float $latitude,
        float $longitude,
        ?int $live_period = null,
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $reply_to_message_id = null,
        ?int $message_thread_id = null,
        ?array $reply_markup = null
    ): object;

    public function sendContact(
        string $phone_number,
        string $first_name,
        ?string $last_name = null,
        ?string $vcard = null,
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $reply_to_message_id = null,
        ?int $message_thread_id = null,
        ?array $reply_markup = null
    ): object;

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
        ?array $reply_markup = null
    ): object;

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
        ?array $reply_markup = null
    ): object;

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
        ?array $reply_markup = null
    ): object;

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
        ?string $message_effect_id = null
    ): object;

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
        ?string $message_effect_id = null
    ): object;

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
        ?string $message_effect_id = null
    ): object;

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
        ?int $start_timestamp = null
    ): object;

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
        ?string $message_effect_id = null
    ): object;

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
        ?string $message_effect_id = null
    ): object;

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
        ?string $message_effect_id = null
    ): object;

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
        ?string $message_effect_id = null
    ): object;

    public function sendMediaGroup(
        array $media,
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $message_thread_id = null,
        ?int $reply_to_message_id = null,
        ?string $business_connection_id = null
    ): object;

    public function sendDice(
        ?string $emoji = "🎲",
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $message_thread_id = null,
        ?int $reply_to_message_id = null,
        ?array $reply_markup = null,
        ?string $business_connection_id = null,
        ?string $message_effect_id = null
    ): object;

    public function setMessageReaction(
        int $message_id,
        ?array $reaction = null,
        bool $is_big = false
    ): object;
}
