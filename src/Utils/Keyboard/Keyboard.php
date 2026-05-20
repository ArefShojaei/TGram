<?php

namespace TGram\Utils\Keyboard;

use TGram\Interfaces\Keyboard\KeyboardFactory;

final class Keyboard implements KeyboardFactory
{
    public static function inline(): InlineKeyboard
    {
        return new InlineKeyboard();
    }
    public static function reply(): ReplyKeyboard
    {
        return new ReplyKeyboard();
    }
}
