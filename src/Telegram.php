<?php

namespace TGram;

use TGram\Abilities\HasListener;
use TGram\DTO\Update;
use TGram\Enums\{BotProcessMode, MediaReciver};
use TGram\Interfaces\Telegram as ITelegram;


final class Telegram extends Bot implements ITelegram
{
    use HasListener;

    
    public function __construct(string $token)
    {
        parent::__construct($token);
    }

    public function run(BotProcessMode $mode = BotProcessMode::POLLING): void
    {
        $offset = 0;

        while (true) {
            $response = $this->getUpdates([
                "query" => ["offset" => $offset],
            ]);

            $updates = json_decode($response->getBody())->result;

            foreach ($updates as $update) {
                $offset = $update->update_id + 1;

                $message = $update->message;
                $user = $message->from;
                $chat = $message->chat;

                /**
                 ** Media handler
                 */
                if (!isset($update->text)) {
                    if (!$this->fallback) {
                        $this->fallback(
                            fn(Context $ctx) => $ctx->reply(
                                "Media not supported!",
                            ),
                        );
                    }

                    $event = MediaReciver::detect($message);

                    $context = new Context(
                        update: new Update(
                            $message,
                            $user,
                            $chat,
                            $update->event,
                        ),
                        bot: $this,
                    );

                    $callback = $this->events[$event] ?? $this->fallback;

                    call_user_func($callback, $context);

                    $this->fallback = null;
                }

                /**
                 ** Message handler
                 */
                $context = new Context(
                    update: new Update($message, $user, $chat, $update->text),
                    bot: $this,
                );

                # Is Command
                if (str_starts_with($update->text, "/")) {
                    $command = ltrim($update->text, "/");

                    if (!$this->fallback) {
                        $this->fallback(
                            fn(Context $ctx) => $ctx->reply(
                                "Command not found!",
                            ),
                        );
                    }

                    $callback = $this->commands[$command] ?? $this->fallback;

                    call_user_func($callback, $context);

                    $this->fallback = null;
                }

                # Is Text
                if (!str_starts_with($update->text, "/")) {
                    if (!$this->fallback) {
                        $this->fallback(
                            fn(Context $ctx) => $ctx->reply("Error!"),
                        );
                    }

                    $callback = $this->hears[$update->text] ?? $this->fallback;

                    call_user_func($callback, $context);

                    $this->fallback = null;
                }
            }

            # Repeat the loop
            $PER_ONE_SECOND = 1;

            sleep($PER_ONE_SECOND);
        }
    }
}
