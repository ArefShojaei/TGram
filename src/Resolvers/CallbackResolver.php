<?php

namespace TGram\Resolvers;

use TGram\Bot;
use TGram\Context;
use TGram\DTO\Update;
use TGram\Interfaces\{MessageResolver as Resolver, MessageStrategy};
use TGram\Messages\CallbackMessageStrategy;

final class CallbackResolver implements Resolver
{
    private ?MessageStrategy $strategy;

    private Context $context;

    public function __construct(private object $update, private Bot $bot)
    {
        $this->context = new Context(
            update: new Update(
                message: $this->update->callback_query->message,
                user: $this->update->callback_query->message->from,
                chat: $this->update->callback_query->message->chat,
                date: $this->update->callback_query->message->date,
                input: $this->update->callback_query->message->text,
                callback_id: $this->update->callback_query->id,
                callback_data: $this->update->callback_query->data,
            ),
            bot: $this->bot,
        );
    }

    public function dispatch(): void
    {
        $this->strategy = new CallbackMessageStrategy(
            $this->bot->getCallback(),
        );

        $this->strategy->handle($this->context);
    }
}
