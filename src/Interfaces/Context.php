<?php

namespace TGram\Interfaces;


interface Context
{
    public function reply(string $text): object;

    public function send(string $text): object;
}
