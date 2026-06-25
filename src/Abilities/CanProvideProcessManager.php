<?php

namespace TGram\Abilities;

use Throwable;

use TGram\Utils\Settings;
use TGram\Enums\HttpStatusCode;
use TGram\Validators\WebhookRequestValidator;
use TGram\Resolvers\{CallbackResolver, MessageResolver};
use TGram\Exceptions\{HttpBodyRawException, UpdateException};

trait CanProvideProcessManager
{
    private const CALLBACK_QUERY_PROPERTY = "callback_query";

    private const MESSAGE_PROPERTY = "message";

    private function runPolling(): void
    {
        $interval = Settings::get("polling.interval", 1);

        $offset = Settings::get("polling.offset", 0);

        while (true) {
            $response = $this->getUpdates([
                "query" => [
                    "offset" => $offset,
                    "limit" => Settings::get("polling.limit", 0),
                    "timeout" => Settings::get("polling.timeout", 0),
                ],
            ]);

            $updates = $response->result;

            if (empty($updates) || !is_array($updates)) continue;

            foreach ($updates as $update) {
                $offset = $update->update_id + 1;

                $this->processUpdate($update);
            }

            sleep($interval);
        }
    }

    private function runWebhook(): void
    {
        $validator = new WebhookRequestValidator;

        if (!$validator->validate()) {
            http_response_code(HttpStatusCode::FORBIDDEN->value);

            return;
        }

        try {
            $bodyRaw = file_get_contents("php://input");

            if (!$bodyRaw) throw new HttpBodyRawException();

            $update = json_decode($bodyRaw);

            if (!$update) throw new UpdateException();

            $this->processUpdate($update);

            http_response_code(HttpStatusCode::OK->value);
        } catch (Throwable $error) {
            http_response_code(HttpStatusCode::INTERNAL_SERVER_ERROR->value);

            throw $error;
        }
    }

    private function processUpdate(object $update): void
    {
        if (property_exists($update, self::CALLBACK_QUERY_PROPERTY)) {
            $callbackResolver = new CallbackResolver($update, $this);

            $callbackResolver->dispatch();
        }

        if (property_exists($update, self::MESSAGE_PROPERTY)) {
            $messageResolver = new MessageResolver($update, $this);

            $messageResolver->dispatch();
        }
    }
}
