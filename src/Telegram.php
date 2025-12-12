<?php

namespace TGram;

use TGram\Abilities\CanProvideListener;
use TGram\Utils\Console;
use TGram\DTO\Update;
use TGram\Enums\{ProcessMode, MediaType};
use TGram\Interfaces\Telegram as ITelegram;


final class Telegram extends Bot implements ITelegram
{
    use CanProvideListener;


    public function __construct(string $token)
    {
        parent::__construct($token);
    }

    public function run(ProcessMode $mode = ProcessMode::POLLING): void
    {
        echo Console::info("Bot is running...") . PHP_EOL;

        $offset = 0;

        while (true) {
            $response = $this->getUpdates([
                "query" => ["offset" => $offset],
            ]);

            $updates = $response->result;

            if (!count($updates)) continue;

            foreach ($updates as $update) {
                $offset = $update->update_id + 1;

                if (!property_exists($update, "message")) continue;

                $message = $update->message;
                $user = $message->from;
                $chat = $message->chat;

                # Message handler
                if (property_exists($message, "text")) {
                    $input = $message->text;

                    $context = new Context(
                        update: new Update(
                            $message,
                            $user,
                            $chat,
                            $input,
                        ),
                        bot: $this,
                    );

                    # Is Command
                    if (str_starts_with($input, "/")) {
                        $command = ltrim($input, "/");

                        if (!$this->fallback) $this->fallback(fn(Context $ctx) => $ctx->sendMessage("Command not found!"));

                        $callback = $this->commands[$command] ?? $this->fallback;

                        call_user_func($callback, $context);

                        $this->fallback = null;
                    }

                    # Is Text
                    if (!str_starts_with($input, "/")) {
                        if (!$this->fallback) $this->fallback(fn(Context $ctx) => $ctx->sendMessage("Error!"),);

                        $callback = $this->hears[$input] ?? $this->fallback;

                        call_user_func($callback, $context);

                        $this->fallback = null;
                    }
                }

                // # Media Handler
                $event = MediaType::detect($message);

                if (property_exists($message, $event)) {
                    $context = new Context(
                        update: new Update(
                            $message,
                            $user,
                            $chat,
                            $message->{$event},
                        ),
                        bot: $this,
                    );

                    if (!$this->fallback) $this->fallback(fn(Context $ctx) => $ctx->sendMessage("Command not found!"));

                    $callback = $this->events[$event] ?? $this->fallback;

                    call_user_func($callback, $context);

                    $this->fallback = null;
                }
            }

            $PER_ONE_SECOND = 1;

            sleep($PER_ONE_SECOND);
        }
    }
}
