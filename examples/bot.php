<?php

require_once dirname(__DIR__) . "/vendor/autoload.php";

use TGram\{Telegram, Context};


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

    $keyboard = [
        "keyboard" => [
            [
                [
                    "text" => "🤖 Github",
                ],
            ],
        ],
        "resize_keyboard" => true,
        "one_time_keyboard" => true,
    ];

    $context->sendMessage($message, reply_markup: $keyboard);
});

$app->hears("🤖 Github", function (Context $context) {
    $message = "Github information";

    $keyboard = [
        "inline_keyboard" => [
            [
                [
                    "text" => "Developer",
                    "url" => "https://github.com/ArefShojaei",
                ],
                [
                    "text" => "Repository",
                    "url" => "https://github.com/ArefShojaei/TGram",
                ],
            ],
        ],
    ];

    $context->sendMessage($message, reply_markup: $keyboard);
});

$app->run();
