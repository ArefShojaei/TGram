<?php

namespace TGram\Resolvers;

use TGram\Bot;
use TGram\Context;
use TGram\DTO\Update;
use TGram\Enums\MediaType;
use TGram\Executors\MiddlewareExecutor;
use TGram\Interfaces\Message\{MessageResolver as Resolver, MessageStrategy};
use TGram\Messages\{
    CommandMessageStrategy,
    MediaMessageStrategy,
    TextMessageStrategy,
};

final class MessageResolver extends MiddlewareExecutor implements Resolver
{
    private ?MessageStrategy $strategy = null;

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

        parent::__construct($this->context, $this->bot->getMiddlewares());

        is_null($this->next)
            ? # Run without middlewares
                !is_null($this->strategy) &&
                $this->strategy->handle($this->context)
            : # Run with middlewares
                $this->next &&
                !is_null($this->strategy) &&
                $this->strategy->handle($this->context);
    }
}
