<?php

namespace TGram\Enums;

enum FallbackMessage: string
{
    case MEDIA = "Media not supported!";

    case TEXT = "Message not understood!";

    case COMMAND = "Unknown command!";
}
