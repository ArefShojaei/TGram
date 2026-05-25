<?php

namespace TGram\Interfaces;

use TGram\Interfaces\Chat\{
    HasCallbackQuery,
    HasChatManager,
    HasMediaSender,
    HasMessageManager,
};

interface Context extends
    HasMediaSender,
    HasChatManager,
    HasMessageManager,
    HasCallbackQuery {}
