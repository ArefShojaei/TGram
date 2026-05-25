<?php

namespace TGram\Resolvers;

use TGram\Bot;
use TGram\Context;
use TGram\DTO\Update;
use TGram\Executors\MiddlewareExecutor;
use TGram\Interfaces\Message\{MessageResolver as Resolver, MessageStrategy};
use TGram\Messages\CallbackMessageStrategy;

final class CallbackResolver extends MiddlewareExecutor implements Resolver
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
                callback_query_id: $this->update->callback_query->id,
                callback_query_data: $this->update->callback_query->data,
            ),
            bot: $this->bot,
        );
    }

    public function dispatch(): void
    {
        $this->strategy = new CallbackMessageStrategy(
            $this->bot->getCallback(),
        );

        parent::__construct($this->context, $this->bot->getMiddlewares());

        is_null($this->next)
            ? # Run without middlewares
            $this->strategy->handle($this->context)
            : # Run with middlewares
                $this->next && $this->strategy->handle($this->context);
    }
}
