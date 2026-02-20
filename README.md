# PHP Telegram Bot
A Powerful PHP library for making own Telegram bot easily!

```php
<?php

require __DIR__ . "/vendor/autoload.php";

use TGram\{Telegram, Context};


$app = new Telegram("TOKEN");

$app->start(function(Context $ctx) {
    $ctx->sendMessage("Hello");
});

$app->run();
```