<?php

namespace TGram\Utils\Keyboard;

use TGram\Interfaces\Arrayable;
use TGram\Interfaces\Keyboard\KeyboardRowable;

final class InlineKeyboard implements KeyboardRowable, Arrayable
{
    private array $rows = [];

    public function row(array ...$buttons): self
    {
        $this->rows[] = $buttons;

        return $this;
    }

    public function toArray(): array
    {
        return [
            "inline_keyboard" => $this->rows,
        ];
    }
}
