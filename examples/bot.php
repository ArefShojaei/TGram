<?php

require_once dirname(__DIR__) . "/vendor/autoload.php";

use TGram\{Telegram, Context};
use TGram\Utils\Keyboard\{Keyboard, Button};

$app = new Telegram("TOKEN");

$app->start(function (Context $context) {
    $user = $context->update->user;
    $is_bot = $user->is_bot ? "true" : "false";

    $message = "
Welcome to <b>TGram</b> bot 🚀

👤 You
├ id: <b>{$user->id}</b>
├ firstname: <b>{$user->first_name}</b>
├ username: <b>{$user->username}</b>
├ is_bot: <b>{$is_bot}</b>
└ language_code: <b>{$user->language_code}</b>


https://github.com/ArefShojaei/TGram
    ";

    $keyboard = Keyboard::reply()->row(Button::text("🤖 Github"))->toArray();

    $context->sendMessage($message, reply_markup: $keyboard);
});

$app->hears("🤖 Github", function (Context $context) {
    $message = "Github information";

    $keyboard = Keyboard::inline()
        ->row(
            Button::url("Developer", "https://github.com/ArefShojaei"),
            Button::url("Repository", "https://github.com/ArefShojaei/TGram"),
        )
        ->toArray();

    $context->sendMessage($message, reply_markup: $keyboard);
});

$app->run();
