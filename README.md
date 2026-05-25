# TGram - PHP Telegram Bot Library

<div align="center">
    <img src="docs/Logo.jpg" width="256" alt="TGram Logo" />
    
   **A Powerful and Easy-to-Use PHP Library for Building Telegram Bots**

   [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
   [![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-blue)](https://php.net)
</div>

---

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Quick Start](#quick-start)
- [Core Concepts](#core-concepts)
- [Basic Usage](#basic-usage)
- [Handling Messages](#handling-messages)
- [Sending Messages](#sending-messages)
- [Keyboards](#keyboards)
- [Advanced Features](#advanced-features)
- [Configuration](#configuration)
- [Examples](#examples)
- [Testing](#testing)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)
- [License](#license)

---

## Introduction

**TGram** is a modern, user-friendly PHP framework for building Telegram bots. Whether you're creating a simple bot that responds to messages or building a complex interactive application, TGram provides all the tools you need with an intuitive API.

With TGram, you can:
- Easily create Telegram bots in PHP
- Handle messages and commands with simple syntax
- Build interactive keyboards and menus
- Manage user interactions effortlessly
- Deploy using polling or webhook methods

---

## Features

✨ **Key Features:**

- **Simple API**: Clean, intuitive syntax for developers of all levels
- **Command Handling**: Built-in support for bot commands (`/start`, `/help`, etc.)
- **Message Listeners**: Listen for specific messages or patterns
- **Keyboard Support**: Create inline and reply keyboards with buttons
- **Message Types**: Handle text, photos, documents, and more
- **Chat Management**: Manage chat information and user interactions
- **Multiple Modes**: Support for both Polling and Webhook processing
- **Error Handling**: Robust exception handling and error reporting
- **Modern PHP**: Built with PHP 8.0+ features (attributes, typed properties, etc.)
- **Well-Structured**: Organized codebase with clear separation of concerns
- **Fully Tested**: Comprehensive test suite with 105+ tests

---

## Requirements

Before you start, make sure you have:

- **PHP 8.2** or higher
- **Composer** (dependency manager for PHP)
- **Active Telegram Bot Token** (create one via [BotFather](https://t.me/BotFather))

---

## Installation

### Option 1: Using Composer (Recommended)

The easiest way to install TGram is through Composer:

```bash
composer require arefshojaei/tgram
```

This will download TGram and all its dependencies automatically.

### Option 2: Manual Clone

If you prefer to clone the repository directly:

```bash
git clone https://github.com/ArefShojaei/TGram.git
cd TGram
composer install
```

---

## Quick Start

Here's the simplest way to get your first bot running:

```php
<?php

require __DIR__ . "/vendor/autoload.php";

use TGram\{Telegram, Context};

// Create a new bot instance with your token
$app = new Telegram("YOUR_BOT_TOKEN_HERE");

// Handle /start command
$app->start(function(Context $ctx) {
    $ctx->sendMessage("Hello! 👋 I'm your bot!");
});

// Run the bot
$app->run();
```

**That's it!** Your bot will now:
1. Listen for incoming messages
2. Respond to `/start` command with a greeting
3. Keep running and polling for new messages

### Getting Your Bot Token

1. Open Telegram and search for **@BotFather**
2. Start the conversation and type `/newbot`
3. Follow the prompts to create your bot
4. Copy your token and replace `"YOUR_BOT_TOKEN_HERE"` in the code above

---

## Core Concepts

### The Telegram Class

The `Telegram` class is your main application. It's the entry point for all bot functionality:

```php
$bot = new Telegram("TOKEN");
```

### The Context Object

The `Context` object is passed to your handlers and contains:
- **Update Information**: Details about the incoming message
- **User Information**: Who sent the message
- **Methods**: Functions to send responses

```php
$app->start(function(Context $context) {
    // Access the user
    $user = $context->update->user;
    echo $user->first_name; // User's first name
    
    // Send a response
    $context->sendMessage("Hello!");
});
```

### Processing Modes

TGram supports two ways to receive updates:

**Polling** (Default - Long Polling):
- Your bot continuously asks Telegram for new messages
- Simple to set up, no server required
- Good for development and small deployments

**Webhook** (Server-based):
- Telegram sends updates directly to your server
- More efficient for production
- Requires a public URL and SSL certificate

```php
use TGram\Enums\ProcessMode;

// Start with polling (default)
$app->run(ProcessMode::POLLING);

// Or use webhook
$app->run(ProcessMode::WEBHOOK);
```

---

## Basic Usage

### 1. Handling the /start Command

The `/start` command is special - it's sent when a user first interacts with your bot:

```php
$app->start(function(Context $ctx) {
    $user = $ctx->update->user;
    $message = "Welcome, {$user->first_name}! 👋";
    $ctx->sendMessage($message);
});
```

### 2. Listening for Specific Commands

Handle custom commands with the `command()` method:

```php
$app->command("/help", function(Context $ctx) {
    $message = "
📖 **Available Commands:**
/start - Start the bot
/help - Show this help message
/about - Learn about me
    ";
    $ctx->sendMessage($message);
});

$app->command("/about", function(Context $ctx) {
    $ctx->sendMessage("I'm a TGram bot! 🤖");
});
```

### 3. Listening for Specific Messages

Use the `hears()` method to respond to exact messages:

```php
$app->hears("Hello", function(Context $ctx) {
    $ctx->sendMessage("Hello to you too! 👋");
});

$app->hears("How are you?", function(Context $ctx) {
    $ctx->sendMessage("I'm doing great, thanks for asking! 😊");
});
```

### 4. Handling Any Message

Catch all messages that don't match other handlers:

```php
$app->fallback(function(Context $ctx) {
    $message = $ctx->update->message;
    $ctx->sendMessage("I didn't understand that. Try /help");
});
```

---

## Handling Messages

### Accessing Message Information

When a message arrives, you can access detailed information:

```php
$app->start(function(Context $ctx) {
    $message = $ctx->update->message;
    $user = $ctx->update->user;
    
    // Message details
    echo $message->message_id;  // Unique message ID
    echo $message->text;         // Message text
    echo $message->chat->id;     // Chat ID
    
    // User details
    echo $user->id;              // User's numeric ID
    echo $user->first_name;      // First name
    echo $user->username;        // Username (if set)
    echo $user->is_bot;          // Is this user a bot?
});
```

### Different Message Types

Handle different types of messages:

```php
// Text messages (default)
$app->hears("text", function(Context $ctx) {
    // Handle text
});

// Photo messages
$app->onPhoto(function(Context $ctx) {
    $ctx->sendMessage("Nice photo! 📸");
});

// Document messages
$app->onDocument(function(Context $ctx) {
    $ctx->sendMessage("Document received! 📄");
});

// Voice messages
$app->onVoice(function(Context $ctx) {
    $ctx->sendMessage("Voice received! 🎙️");
});
```

---

## Sending Messages

### Simple Text Messages

```php
$ctx->sendMessage("Hello, world!");
```

### Formatted Messages

Use HTML or Markdown formatting:

```php
// HTML formatting
$message = "This is <b>bold</b> and <i>italic</i> text";
$ctx->sendMessage($message);

// Multiple lines
$message = "
<b>Title</b>
Hello <i>world</i>
Line 3
";
$ctx->sendMessage($message);
```

### Sending with Options

Add additional parameters to customize your message:

```php
$ctx->sendMessage(
    "Hello!",
    parse_mode: "HTML",           // or "Markdown"
    disable_web_page_preview: true // Don't show link previews
);
```

### Sending Media

```php
// Send a photo
$ctx->sendPhoto(
    "https://example.com/photo.jpg",
    caption: "Beautiful photo! 📸"
);

// Send a document
$ctx->sendDocument(
    "https://example.com/file.pdf",
    caption: "Important document"
);

// Send voice
$ctx->sendVoice("https://example.com/audio.ogg");
```

### Editing Messages

Update previously sent messages:

```php
$ctx->editMessageText(
    text: "Updated message",
    message_id: $messageId,
    chat_id: $chatId
);
```

---

## Keyboards

### Reply Keyboards (Bottom Menu)

Reply keyboards appear as a menu at the bottom of the chat:

```php
use TGram\Utils\Keyboard\{Keyboard, Button};

$keyboard = Keyboard::reply()
    ->row(Button::text("Option 1"), Button::text("Option 2"))
    ->row(Button::text("Option 3"))
    ->toArray();

$ctx->sendMessage("Choose an option:", reply_markup: $keyboard);
```

### Inline Keyboards (Above Message)

Inline keyboards appear directly above or below messages:

```php
$keyboard = Keyboard::inline()
    ->row(
        Button::url("GitHub", "https://github.com/ArefShojaei/TGram"),
        Button::url("Docs", "https://example.com/docs")
    )
    ->row(Button::callback("Delete", "action_delete"))
    ->toArray();

$ctx->sendMessage("Check these links:", reply_markup: $keyboard);
```

### Button Types

**Text Button:**
```php
Button::text("Click me")
```

**URL Button:**
```php
Button::url("Visit GitHub", "https://github.com")
```

**Callback Button:**
```php
Button::callback("Vote 👍", "vote_yes")
```

**Web App Button:**
```php
Button::webApp("Open App", "https://example.com/app")
```

### Keyboard Examples

**Simple Row:**
```php
$keyboard = Keyboard::reply()
    ->row(Button::text("Yes"), Button::text("No"))
    ->toArray();
```

**Multiple Rows:**
```php
$keyboard = Keyboard::reply()
    ->row(Button::text("Option 1"))
    ->row(Button::text("Option 2"))
    ->row(Button::text("Option 3"))
    ->row(Button::text("Option 4"))
    ->toArray();
```

**Hide Keyboard:**
```php
$ctx->sendMessage("Keyboard hidden", 
    reply_markup: ["remove_keyboard" => true]
);
```

---

## Advanced Features

### Custom Configuration

Configure your bot behavior:

```php
$bot = new Telegram("TOKEN");

$bot->configure([
    "polling_interval" => 2,      // Check for messages every 2 seconds
    "max_attempts" => 3,           // Retry failed requests 3 times
    "timeout" => 30,               // Request timeout in seconds
    "debug_mode" => true,          // Enable debug logging
]);

$bot->run();
```

### Handling Button Callbacks

When users click inline buttons, handle the callback:

```php
$app->onCallbackQuery(function(Context $ctx) {
    $callbackData = $ctx->update->callback_query->data;
    
    if ($callbackData === "vote_yes") {
        $ctx->answerCallbackQuery("Thanks for voting! ✅");
        // Update message or send new one
    }
});
```

### Chat Management

Get and manage chat information:

```php
$app->start(function(Context $ctx) {
    $chat = $ctx->update->message->chat;
    
    echo $chat->id;           // Chat ID
    echo $chat->title;        // Chat title (for groups)
    echo $chat->type;         // "private", "group", "supergroup", etc.
    
    // Get chat info from API
    $chatInfo = $ctx->getChatInfo();
});
```

### User Information

Access detailed user data:

```php
$user = $ctx->update->user;

echo $user->id;              // Unique user ID
echo $user->is_bot;          // Is a bot?
echo $user->first_name;      // First name
echo $user->last_name;       // Last name (optional)
echo $user->username;        // Username (optional)
echo $user->language_code;   // User's language
```

### Middleware & Filters

Create custom filters for advanced message handling:

```php
$app->command("/admin", function(Context $ctx) {
    // Check if user is admin
    if ($ctx->update->user->id !== ADMIN_ID) {
        $ctx->sendMessage("❌ You don't have permission");
        return;
    }
    
    $ctx->sendMessage("✅ Admin panel");
});
```

---

## Configuration

### Environment Variables

Store your token securely using environment variables:

```php
// .env file
TELEGRAM_BOT_TOKEN=your_token_here

// In your code
$token = getenv("TELEGRAM_BOT_TOKEN");
$app = new Telegram($token);
```

### Webhook Configuration

To use webhooks instead of polling:

```php
$app = new Telegram("TOKEN");

$app->configure([
    "webhook_url" => "https://your-domain.com/webhook.php",
    "webhook_port" => 443,  // HTTPS port
]);

$app->run(ProcessMode::WEBHOOK);
```

---

## Examples

### Example 1: Echo Bot

A bot that repeats everything the user sends:

```php
<?php
require __DIR__ . "/vendor/autoload.php";

use TGram\{Telegram, Context};

$app = new Telegram("TOKEN");

$app->start(function(Context $ctx) {
    $ctx->sendMessage("Send me anything and I'll repeat it!");
});

$app->fallback(function(Context $ctx) {
    $text = $ctx->update->message->text;
    $ctx->sendMessage("You said: " . $text);
});

$app->run();
```

### Example 2: Calculator Bot

A bot that performs simple calculations:

```php
<?php
require __DIR__ . "/vendor/autoload.php";

use TGram\{Telegram, Context};

$app = new Telegram("TOKEN");

$app->start(function(Context $ctx) {
    $ctx->sendMessage("Send me math like: 2 + 2");
});

$app->hears("/calculate", function(Context $ctx) {
    $ctx->sendMessage("Type your calculation (e.g., 5 * 3)");
});

$app->fallback(function(Context $ctx) {
    $text = $ctx->update->message->text;
    
    // Simple calculation
    if (preg_match('/(\d+)\s*([\+\-\*\/])\s*(\d+)/', $text, $matches)) {
        $a = (int)$matches[1];
        $op = $matches[2];
        $b = (int)$matches[3];
        
        $result = match($op) {
            '+' => $a + $b,
            '-' => $a - $b,
            '*' => $a * $b,
            '/' => $b !== 0 ? $a / $b : "Cannot divide by zero",
        };
        
        $ctx->sendMessage("Result: $result");
    }
});

$app->run();
```

### Example 3: Menu-Based Bot

A bot with navigation buttons:

```php
<?php
require __DIR__ . "/vendor/autoload.php";

use TGram\{Telegram, Context};
use TGram\Utils\Keyboard\{Keyboard, Button};

$app = new Telegram("TOKEN");

$app->start(function(Context $ctx) {
    $keyboard = Keyboard::reply()
        ->row(Button::text("📚 Learn"))
        ->row(Button::text("🎮 Games"))
        ->row(Button::text("⚙️ Settings"))
        ->toArray();
    
    $ctx->sendMessage("Welcome! Choose an option:", reply_markup: $keyboard);
});

$app->hears("📚 Learn", function(Context $ctx) {
    $ctx->sendMessage("Learning resources coming soon!");
});

$app->hears("🎮 Games", function(Context $ctx) {
    $keyboard = Keyboard::inline()
        ->row(
            Button::callback("🎲 Dice", "game_dice"),
            Button::callback("🃏 Card", "game_card")
        )
        ->toArray();
    
    $ctx->sendMessage("Pick a game:", reply_markup: $keyboard);
});

$app->hears("⚙️ Settings", function(Context $ctx) {
    $ctx->sendMessage("Settings panel will be here");
});

$app->run();
```

---

## Testing

TGram includes a comprehensive test suite with 105+ tests covering all major features and components.

### Test Structure

The test suite is organized into two main categories:

**Unit Tests** - Test individual components in isolation:
- Core classes (Bot, Telegram, Context)
- Exceptions and error handling
- Enums and data types
- Abilities and traits
- Utilities and helpers

**Feature Tests** - Test complete workflows:
- Bot initialization flow
- Command handling
- Message listening
- Keyboard interactions
- Exception handling

### Running Tests

#### Install Development Dependencies

```bash
composer install
```

This automatically installs PHPUnit and other testing dependencies defined in `composer.json`.

#### Run All Tests

Execute the complete test suite:

```bash
vendor/bin/phpunit
```

This runs all 105+ tests and generates a summary report.

#### Run Specific Test Categories

**Run only Unit Tests:**
```bash
vendor/bin/phpunit tests/Unit/
```

**Run only Feature Tests:**
```bash
vendor/bin/phpunit tests/Feature/
```

#### Run Individual Test Classes

**Test Telegram class:**
```bash
vendor/bin/phpunit tests/Unit/Core/TelegramTest.php
```

**Test Exception handling:**
```bash
vendor/bin/phpunit tests/Unit/Exceptions/InvalidTokenExceptionTest.php
```

**Test Keyboard utilities:**
```bash
vendor/bin/phpunit tests/Unit/Utils/KeyboardTest.php
```

**Test listener abilities:**
```bash
vendor/bin/phpunit tests/Unit/Abilities/CanProvideListenerTest.php
```

#### Run Tests with Filters

Run tests matching a pattern:

```bash
vendor/bin/phpunit --filter testConstructor
```

Run tests for a specific method:

```bash
vendor/bin/phpunit --filter CanProvideListener
```

#### Generate Coverage Reports

Generate HTML code coverage report:

```bash
vendor/bin/phpunit --coverage-html coverage/
```

The report will be saved in the `coverage/` directory. Open `coverage/index.html` in a browser to view detailed coverage information.

Generate text coverage summary:

```bash
vendor/bin/phpunit --coverage-text
```

Generate clover format for CI/CD integration:

```bash
vendor/bin/phpunit --coverage-clover coverage.xml
```

#### Verbose and Detailed Output

Run tests with verbose output:

```bash
vendor/bin/phpunit -v
```

Run tests with very verbose output:

```bash
vendor/bin/phpunit -vv
```

Run tests and generate test documentation (testdox):

```bash
vendor/bin/phpunit --testdox
```

Save testdox output to file:

```bash
vendor/bin/phpunit --testdox > testdox.txt
```

#### Parallel Test Execution

Run tests in parallel (if supported):

```bash
vendor/bin/phpunit -p
```

#### Custom Test Configuration

All test settings are configured in `phpunit.xml`:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="https://schema.phpunit.de/10.5/phpunit.xsd"
         bootstrap="vendor/autoload.php"
         cacheDirectory=".phpunit.cache"
         executionOrder="depends,defects"
         beStrictAboutCoverageMetadata="true"
         beStrictAboutOutputDuringTests="true"
         failOnRisky="true"
         colors="true"
         testdox="true"
         failOnWarning="true">
    <testsuites>
        <testsuite name="default">
            <directory>tests</directory>
        </testsuite>
    </testsuites>

    <source restrictDeprecations="true" restrictNotices="true" restrictWarnings="true">
        <include>
            <directory>src</directory>
        </include>
    </source>
</phpunit>
```

### Common Test Commands

```bash
# Quick test run
vendor/bin/phpunit

# Full test suite with coverage
vendor/bin/phpunit --coverage-html coverage/

# Generate test documentation
vendor/bin/phpunit --testdox > tests.txt

# Test a specific component
vendor/bin/phpunit tests/Unit/Core/

# Stop after first failure
vendor/bin/phpunit --stop-on-failure

# Stop after N failures
vendor/bin/phpunit --stop-on-defect=5

# Run tests in reverse order
vendor/bin/phpunit --reverse-order

# Show only skipped and incomplete tests
vendor/bin/phpunit --list-tests

# Display interactive menu
vendor/bin/phpunit --interactive
```

### Test Files Location

All tests are located in the `tests/` directory:

```
tests/
├── Helpers/
│   └── TestHelper.php                    # Test utility functions
├── Fixtures/
│   ├── FakeUpdateData.php               # Mock Telegram data
│   └── FakeTelegramResponse.php          # Mock API responses
├── Unit/
│   ├── Core/
│   │   ├── BotTest.php
│   │   ├── TelegramTest.php
│   │   └── ContextTest.php
│   ├── Exceptions/
│   │   ├── InvalidTokenExceptionTest.php
│   │   └── ValidationExceptionTest.php
│   ├── Enums/
│   │   ├── ProcessModeTest.php
│   │   └── HttpMethodTest.php
│   ├── Abilities/
│   │   └── CanProvideListenerTest.php
│   └── Utils/
│       ├── KeyboardTest.php
│       ├── ButtonTest.php
│       └── ConsoleTest.php
└── Feature/
    ├── BotInitializationTest.php
    ├── CommandHandlingTest.php
    ├── MessageListeningTest.php
    ├── KeyboardInteractionTest.php
    └── ExceptionHandlingTest.php
```

### Test Coverage Goals

- **Overall**: 85%+ coverage
- **Core Classes**: 90%+ coverage
- **Exceptions**: 100% coverage
- **Enums**: 100% coverage
- **Utilities**: 85%+ coverage

### Writing New Tests

To add new tests:

1. Create test file in appropriate directory under `tests/`
2. Extend `PHPUnit\Framework\TestCase`
3. Name test methods with `test` prefix
4. Use descriptive names: `testConstructorWithValidToken()`
5. Follow Arrange-Act-Assert pattern

Example test:

```php
<?php

namespace Tests\Unit\Core;

use PHPUnit\Framework\TestCase;
use TGram\Telegram;

class MyNewTest extends TestCase
{
    public function testSomethingWorks(): void
    {
        // Arrange
        $bot = new Telegram('token');
        
        // Act
        $result = $bot->doSomething();
        
        // Assert
        $this->assertTrue($result);
    }
}
```

---

## Troubleshooting

### Bot Not Responding

**Problem:** Bot doesn't respond to messages

**Solutions:**
1. Verify your bot token is correct
2. Check that your bot is actually running
3. Make sure you've started a conversation with `/start`
4. Check your bot's privacy settings with @BotFather

### Connection Errors

**Problem:** "Connection refused" or timeout errors

**Solutions:**
1. Check your internet connection
2. Verify Telegram API is accessible from your server
3. Increase timeout in configuration
4. Check firewall rules if on a server

### Messages Not Sending

**Problem:** `sendMessage()` doesn't work

**Solutions:**
1. Verify chat ID is correct
2. Ensure the context object is valid
3. Check error messages in logs
4. Test with a simple text message first

### Memory Issues

**Problem:** Bot crashes or uses too much memory

**Solutions:**
1. Reduce `polling_interval` to check less frequently
2. Avoid storing large data in memory
3. Clear temporary files regularly
4. Monitor memory usage with `memory_get_usage()`

### Test Failures

**Problem:** Tests are failing

**Solutions:**
1. Ensure PHPUnit is installed: `composer install`
2. Check PHP version is 8.0+: `php -v`
3. Verify all dependencies are installed: `composer update`
4. Run tests with verbose output: `vendor/bin/phpunit -v`
5. Check test configuration in `phpunit.xml`

---

## Contributing

We welcome contributions! To contribute:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Write tests for your changes
4. Ensure all tests pass: `vendor/bin/phpunit`
5. Commit your changes (`git commit -m 'Add amazing feature'`)
6. Push to the branch (`git push origin feature/amazing-feature`)
7. Open a Pull Request

### Before Submitting a PR

- ✅ Run the full test suite
- ✅ Ensure code coverage is maintained
- ✅ Follow PSR-4 autoloading standards
- ✅ Use English for code and comments
- ✅ Update documentation if needed

---

## License

This project is licensed under the **MIT License** - see the LICENSE file for details.

---

## Support

For more information:

- 📖 [Documentation](https://github.com/ArefShojaei/TGram)
- 🐛 [Report Issues](https://github.com/ArefShojaei/TGram/issues)
- 💬 [Discussions](https://github.com/ArefShojaei/TGram/discussions)
- 📧 Email: arefshojaei82@gmail.com

---

## Acknowledgments

- Built with ❤️ by [Aref Shojaei](https://github.com/ArefShojaei)
- Powered by the [Telegram Bot API](https://core.telegram.org/bots/api)
- Uses [Guzzle HTTP Client](https://docs.guzzlephp.org/)

---

**Happy Bot Building! 🚀**