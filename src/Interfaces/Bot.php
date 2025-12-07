<?php

namespace TGram\Interfaces;


interface Bot
{
    public function getMe(): object;

    public function getUpdates(array $options = []): object;

    public function sendMessage(int $chatId, string $text, array $options = []): object;
}
