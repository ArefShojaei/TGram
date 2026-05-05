<div align="center">
    <img src="docs/Logo.jpg" width="256" />
</div>

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

## Installation
Two ways for installing & using the library
> Clone this repository
```bash
git clone https://github.com/ArefShojaei/TGram/TGram.git
```

OR

> Composer installer
```bash
composer require arefshojaei/tgram
```
