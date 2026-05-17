<?php

namespace TGram\Resolvers;

use InvalidArgumentException;
use TGram\Bot;
use TGram\Context;
use TGram\DTO\Update;
use TGram\Enums\MediaType;
use TGram\Interfaces\{MessageResolver as Resolver, MessageStrategy};
use TGram\Messages\{
    CommandMessageStrategy,
    MediaMessageStrategy,
    TextMessageStrategy,
};

final class MessageResolver implements Resolver
{
    private ?MessageStrategy $strategy;

    private Context $context;

    public function __construct(private object $message, private Bot $bot)
    {
        $this->context = new Context(
            update: new Update(
                message: $this->message,
                user: $this->message->from,
                chat: $this->message->chat,
                date: $this->message->date,
                input: $this->message->text,
            ),
            bot: $this->bot,
        );
    }

    public function dispatch(): void
    {
        $input = $this->message->text;

        # Command message
        if (
            property_exists($this->message, "text") &&
            str_starts_with($input, "/")
        ) {
            $this->strategy = new CommandMessageStrategy(
                input: $input,
                commands: $this->bot->getCommandList(),
            );
        }

        # Text message
        if (
            property_exists($this->message, "text") &&
            !str_starts_with($input, "/")
        ) {
            $this->strategy = new TextMessageStrategy(
                input: $input,
                hears: $this->bot->getHears(),
            );
        }

        # Media message
        $event = MediaType::detect($this->message);

        if (property_exists($this->message, $event)) {
            $this->context = new Context(
                update: new Update(
                    $this->message,
                    $this->message->user,
                    $this->message->chat,
                    $this->message->date,
                    $this->message->message->{$event},
                ),
                bot: $this->bot,
            );

            $this->strategy = new MediaMessageStrategy(
                event: $event,
                events: $this->bot->getEvents(),
            );
        }

        if (!$this->strategy) {
            throw new InvalidArgumentException();
        }

        $this->strategy->handle($this->context);
    }
}
