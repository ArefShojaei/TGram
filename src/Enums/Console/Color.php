<?php

namespace TGram\Enums\Console;


enum Color: string
{
    /**
     ** Settings
     */
    case ALIAS = "\x1b";

    case RESET = "0m";

    case SYMBOL = "[";

    /**
     ** Text colors
     */
    case TEXT_RED = "31m";

    case TEXT_GREEN = "32m";

    case TEXT_YELLOW = "33m";

    case TEXT_BLUE = "34m";

    /**
     ** Background colors
     */
    case BG_RED = "41m";

    case BG_GREEN = "42m";

    case BG_YELLOW = "43m";

    case BG_BLUE = "44m";
}
