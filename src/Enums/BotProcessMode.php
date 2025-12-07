<?php

namespace TGram\Enums;


enum BotProcessMode: string
{
    case WEBHOOK = "webhook";

    case POLLING = "polling";
}
