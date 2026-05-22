<?php

namespace TGram\Interfaces;

use TGram\Interfaces\Chat\{
    HasChatManager,
    HasMediaSender,
    HasMessageManager,
};

interface Context extends HasMediaSender, HasChatManager, HasMessageManager {}
