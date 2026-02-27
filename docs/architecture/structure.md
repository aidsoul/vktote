# Project Structure

This document describes the VKTote project structure and code organization.

## Directory Overview

```
vktote/
├── app/                    # Application source code
│   ├── Bot.php            # Main bot entry point
│   ├── Config/            # Configuration classes
│   ├── DataBase/          # Database layer
│   ├── Http/              # HTTP controllers
│   ├── Lang/              # Language files
│   ├── Message/           # Error messages
│   ├── Security/          # Security utilities
│   ├── Settings/          # Settings handlers
│   ├── Telegram/          # Telegram integration
│   └── Vk/                # VK API integration
├── groups/                # Group configurations
├── public/                # Public assets
│   ├── css/               # Stylesheets
│   └── js/                # JavaScript files
├── view/                  # Templates
├── docs/                  # Documentation
├── config.php             # Main configuration
├── index.php              # Web entry point
├── start.php              # CLI entry point
└── composer.json          # Dependencies
```

## Application Core

### Entry Points

| File | Purpose |
|------|---------|
| [`index.php`](../../index.php) | Web application entry point |
| [`start.php`](../../start.php) | CLI bot execution |
| [`config.php`](../../config.php) | Global configuration |

## App Directory Structure

### Config (`app/Config/`)

Handles configuration loading and parsing:

| File | Purpose |
|------|---------|
| [`Config.php`](../../app/Config/Config.php) | Base configuration class |
| [`Api.php`](../../app/Config/Api.php) | API settings |
| [`Bot.php`](../../app/Config/Bot.php) | Bot settings |
| [`Db.php`](../../app/Config/Db.php) | Database settings |
| [`Telegram.php`](../../app/Config/Telegram.php) | Telegram settings |
| [`User.php`](../../app/Config/User.php) | User settings |
| [`Vk.php`](../../app/Config/Vk.php) | VK settings |

### Database (`app/DataBase/`)

Database abstraction and models:

| File | Purpose |
|------|---------|
| [`DataBase.php`](../../app/DataBase/DataBase.php) | Database connection |
| [`PostModel.php`](../../app/DataBase/Models/PostModel.php) | Post data model |
| [`VkgroupModel.php`](../../app/DataBase/Models/VkgroupModel.php) | VK group model |

### HTTP Controllers (`app/Http/Controllers/`)

Request handling and routing:

| File | Purpose |
|------|---------|
| [`Controller.php`](../../app/Http/Controllers/Controller.php) | Base controller |
| [`ApiCotroller.php`](../../app/Http/Controllers/ApiCotroller.php) | API endpoints |
| [`GroupCotroller.php`](../../app/Http/Controllers/GroupCotroller.php) | Group handling |
| [`SettingsController.php`](../../app/Http/Controllers/SettingsController.php) | Settings page |
| [`SiteController.php`](../../app/Http/Controllers/SiteController.php) | Main page |
| [`UserController.php`](../../app/Http/Controllers/UserController.php) | User authentication |

### Language (`app/Lang/`)

Internationalization support:

| File | Purpose |
|------|---------|
| [`Lang.php`](../../app/Lang/Lang.php) | Language handler |
| [`eng.php`](../../app/Lang/eng.php) | English strings |
| [`rus.php`](../../app/Lang/rus.php) | Russian strings |

### Telegram (`app/Telegram/`)

Telegram bot integration:

| File | Purpose |
|------|---------|
| [`Telegram.php`](../../app/Telegram/Telegram.php) | Main Telegram class |
| [`Check.php`](../../app/Telegram/Check.php) | Message checking |
| [`Api/Api.php`](../../app/Telegram/Api/Api.php) | Telegram API wrapper |
| [`Functions/`](../../app/Telegram/Functions/) | Message handlers |
| [`Html/`](../../app/Telegram/Html/) | HTML formatting |

### VK (`app/Vk/`)

VK API integration:

| File | Purpose |
|------|---------|
| [`Api/Api.php`](../../app/Vk/Api/Api.php) | VK API wrapper |
| [`Wall/Wall.php`](../../app/Vk/Wall/Wall.php) | Wall posts handling |
| [`Wall/Attachment/`](../../app/Vk/Wall/Attachment/) | Post attachments |

## Design Patterns

### MVC Pattern
The application follows the Model-View-Controller pattern:
- **Models**: Database models in `app/DataBase/Models/`
- **Views**: Twig templates in `view/`
- **Controllers**: HTTP controllers in `app/Http/Controllers/`

### Configuration Pattern
Uses the Config class with PHP INI file parsing:
- Each config section maps to a configuration class
- Lazy loading of configuration properties

### Factory Pattern
Used in [`FunctionFactory.php`](../../app/Telegram/Functions/FunctionFactory.php) for creating message handlers.

## Dependency Injection

The project uses Composer autoloading with PSR-4 standards:

```json
{
    "autoload": {
        "psr-4": {
            "Vktote\\": "app"
        }
    }
}
```

## Template System

Uses Twig templating engine:
- Templates stored in `view/`
- Layouts in `view/layout/`
- Page-specific templates in `view/settings/`

## Security

- CSRF protection via [`CsrfToken.php`](../../app/Security/CsrfToken.php)
- Session-based authentication
- Password hashing using PHP's password functions

## Public Assets

| Directory | Purpose |
|-----------|---------|
| [`public/css/`](../../public/css/) | Stylesheets |
| [`public/js/`](../../public/js/) | JavaScript files |
| [`public/robots.txt`](../../public/robots.txt) | Search engine directives |

## Groups Directory

The `groups/` directory stores group-specific configurations:
```
groups/
├── user.ini              # User settings
├── test/                # Group "test"
│   └── config.ini       # Group configuration
└── another_group/       # Another group
    └── config.ini
```

## Configuration Flow

1. Global settings in `config.php`
2. Group-specific settings in `groups/*/config.ini`
3. Runtime settings in database

This hierarchical approach allows flexible configuration management.
