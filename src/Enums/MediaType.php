<?php

namespace TGram\Enums;


enum MediaReciver: string
{
    case PHOTO = "photo";

    case VIDEO = "video";

    case STICKER = "sticker";

    case VOICE = "voice";

    case VOICE_NOTE = "voice_note";

    case DOCUMENT = "document";

    case FORWARD = "forward_from_chat";

    case POLL = "poll";

    case CONTACT = "contact";

    case LOCATION = "location";

    case AUDIO = "audio";

    case GIFT = "animation";


    public static function detect(object $message): ?string
    {
        foreach (self::cases() as $type) {
            if (isset($message->{$type->value})) {
                return $type->value;
            }
        }

        return null;
    }
}
