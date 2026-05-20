<?php

namespace TGram\Interfaces\Keyboard;

interface KeyboardRowable
{
    public function row(array ...$buttons): self;
}
