<?php

namespace TGram\Interfaces;


interface Context
{
    public function reply(): object;

    public function send(): object;
}
