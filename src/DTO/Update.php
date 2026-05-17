<?php

namespace TGram\DTO;

final class Update
{
    public function __construct(
        public readonly object $message,
        public readonly object $user,
        public readonly object $chat,
        public readonly int $date,
        public readonly string|object|array $input,
    ) {}
}
