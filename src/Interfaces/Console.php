<?php

namespace TGram\Interfaces;


interface Console
{
    public static function log(string $message): string;

    public static function info(string $message): string;

    public static function success(string $message): string;

    public static function warn(string $message): string;

    public static function error(string $message): string;
}
