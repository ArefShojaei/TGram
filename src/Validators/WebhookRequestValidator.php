<?php

namespace TGram\Validators;

use TGram\Interfaces\Validator;

final class WebhookRequestValidator implements Validator
{
    public function __construct(
        private array $server,
        private string $secretToken,
    ) {}

    public function validate(): bool
    {
        $incoming =
            $this->server["HTTP_X_TELEGRAM_BOT_API_SECRET_TOKEN"] ?? "";

        $expected = $this->secretToken;

        return hash_equals($expected, $incoming);
    }
}
