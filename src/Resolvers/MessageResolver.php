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

    public function __construct(private object $update, private Bot $bot)
    {
        $this->context = new Context(
            update: new Update(
                message: $this->update->message,
                user: $this->update->message->from,
                chat: $this->update->message->chat,
                date: $this->update->message->date,
                input: $this->update->message->text ?? null,
            ),
            bot: $this->bot,
        );
    }

    public function dispatch(): void
    {
        $input = $this->update->message->text ?? null;

        # Command message
        if (
            property_exists($this->update->message, "text") &&
            str_starts_with($input, "/")
        ) {
            $this->strategy = new CommandMessageStrategy(
                input: $input,
                commands: $this->bot->getCommandList(),
            );
        }

        # Text message
        if (
            property_exists($this->update->message, "text") &&
            !str_starts_with($input, "/")
        ) {
            $this->strategy = new TextMessageStrategy(
                input: $input,
                hears: $this->bot->getHears(),
            );
        }

        # Media message
        $event = MediaType::detect($this->update->message);

        if (property_exists($this->update->message, $event)) {
            $this->context = new Context(
                update: new Update(
                    message: $this->update->message,
                    user: $this->update->message->from,
                    chat: $this->update->message->chat,
                    date: $this->update->message->date,
                    input: $this->update->message->{$event},
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
