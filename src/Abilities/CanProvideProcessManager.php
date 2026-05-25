<?php

namespace TGram\Abilities;

use TGram\Resolvers\{CallbackResolver, MessageResolver};

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

            if (!count($updates) || !is_array($updates)) continue;

            foreach ($updates as $update) {
                $offset = $update->update_id + 1;

                if (property_exists($update, "callback_query")) {
                    $callbackResolver = new CallbackResolver($update, $this);

                    $callbackResolver->dispatch();
                }

                if (property_exists($update, "message")) {
                    $messageResolver = new MessageResolver($update, $this);

                    $messageResolver->dispatch();
                }
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
