<?php

namespace TGram\Utils\Keyboard;

use TGram\Interfaces\Arrayable;
use TGram\Interfaces\Keyboard\KeyboardRowable;

final class ReplyKeyboard implements KeyboardRowable, Arrayable
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
            "keyboard" => $this->rows,
            "resize_keyboard" => true,
            "one_time_keyboard" => true,
        ];
    }
}
