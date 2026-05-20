<?php

namespace TGram\Interfaces\Keyboard;

use TGram\Utils\Keyboard\{InlineKeyboard, ReplyKeyboard};

interface KeyboardFactory
{
    public static function inline(): InlineKeyboard;

    public static function reply(): ReplyKeyboard;
}
