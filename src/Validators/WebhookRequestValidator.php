<?php

namespace TGram\Validators;

use TGram\Interfaces\Validator;
use TGram\Utils\Settings;

final class WebhookRequestValidator implements Validator
{
    public function validate(): bool
    {
        $incoming = $_SERVER["HTTP_X_TELEGRAM_BOT_API_SECRET_TOKEN"] ?? null;

        $expected = Settings::get("webhook.secret_token");

        return $incoming === $expected;
    }
}
