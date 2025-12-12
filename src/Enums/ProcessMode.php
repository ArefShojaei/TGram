<?php

namespace TGram\Enums;


enum ProcessMode: string
{
    case WEBHOOK = "webhook";

    case POLLING = "polling";
}
