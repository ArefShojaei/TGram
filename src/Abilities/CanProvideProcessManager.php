<?php

namespace TGram\Abilities;

use TGram\Resolvers\MessageResolver;

trait CanProvideProcessManager
{
    private function runPolling(): void
    {
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

                $resolver = new MessageResolver($message, $this);

                $resolver->dispatch();
            }

            $PER_ONE_SECOND = 1;

            sleep($PER_ONE_SECOND);
        }
    }

    private function runWebhook(): void
    {
        // TODO: Webhook logic code ...
    }
}
